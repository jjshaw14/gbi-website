#!/usr/bin/env bash
# One-shot sync of ./site → SFTP server using lftp's mirror command.
# Uses pure SFTP (no shell access required on the server), which is what
# Cloudways app-level users have.
#
# Usage:
#   ./deploy.sh         — sync site/ to the remote
#   ./deploy.sh --dry   — show what would be uploaded without actually uploading

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
CONFIG_FILE="$SCRIPT_DIR/deploy.config"

if [[ ! -f "$CONFIG_FILE" ]]; then
  echo "❌  $CONFIG_FILE not found."
  echo "    Copy deploy.config.example to deploy.config and fill in your host."
  exit 1
fi

if ! command -v lftp >/dev/null 2>&1; then
  echo "❌  lftp not installed."
  echo "    Install with:  brew install lftp"
  exit 1
fi

# shellcheck disable=SC1090
source "$CONFIG_FILE"

LOCAL_DIR="$SCRIPT_DIR/site"
REMOTE_DIR="$SFTP_REMOTE_PATH"

# lftp mirror flags:
#   --reverse / -R  upload local → remote (instead of download remote → local)
#   --delete        remove files on the server that no longer exist locally
#   --parallel=4    4 concurrent transfers (faster)
#   --verbose       show what's being transferred
#   --exclude-glob  skip files we don't want on the server
DRY_FLAG=""
if [[ "${1:-}" == "--dry" ]]; then
  DRY_FLAG="--dry-run"
  echo "🔍  Dry run — no files will actually be uploaded."
fi

MIRROR_CMD="mirror --reverse --delete --parallel=2 --verbose --no-perms --only-newer $DRY_FLAG \
  --exclude-glob .DS_Store \
  --exclude-glob _archive-bad-certs/ \
  --exclude-glob _archive-bad-logos/ \
  --exclude-glob assets/images/staff/original/ \
  --exclude-glob *.bak \
  '$LOCAL_DIR' '$REMOTE_DIR'"

# Build the lftp connection. Use SSH key if specified; otherwise use password
# stored in SFTP_PASSWORD (you'll be prompted if neither is set).
if [[ -n "${SSH_KEY:-}" ]]; then
  CONNECT="set sftp:connect-program 'ssh -a -x -i $SSH_KEY -p $SFTP_PORT'"
else
  CONNECT="set sftp:auto-confirm yes"
fi

echo "📡  Syncing $LOCAL_DIR/ → $SFTP_USER@$SFTP_HOST:$REMOTE_DIR/"

lftp -u "$SFTP_USER","${SFTP_PASSWORD:-}" "sftp://$SFTP_HOST:$SFTP_PORT" <<EOF
$CONNECT
set sftp:auto-confirm yes
set net:max-retries 2
set net:timeout 30
$MIRROR_CMD
bye
EOF

echo "✅  Done — $(date '+%Y-%m-%d %H:%M:%S')"
