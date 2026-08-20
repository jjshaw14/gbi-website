#!/usr/bin/env bash
# Watch ./site for changes and auto-sync to SFTP server on every save.
# Press Ctrl-C to stop.
#
# First-time setup:
#   brew install fswatch                # one-time
#   cp deploy.config.example deploy.config
#   # edit deploy.config with your host details
#   chmod +x deploy.sh deploy-watch.sh
#
# Usage:
#   ./deploy-watch.sh

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

if ! command -v fswatch >/dev/null 2>&1; then
  echo "❌  fswatch not installed."
  echo "    Install with:  brew install fswatch"
  exit 1
fi

if [[ ! -f "$SCRIPT_DIR/deploy.config" ]]; then
  echo "❌  deploy.config not found. Copy deploy.config.example → deploy.config first."
  exit 1
fi

WATCH_DIR="$SCRIPT_DIR/site"

# Initial sync so the server is up to date before we start watching.
echo "🚀  Initial sync…"
"$SCRIPT_DIR/deploy.sh"

echo ""
echo "👀  Watching $WATCH_DIR for changes. Press Ctrl-C to stop."
echo ""

# fswatch options:
#   -o   one event per batch (collapses rapid saves)
#   --latency 1.0  wait 1s after a save before triggering (debounce)
#   --exclude  skip noise (e.g., editor swap/dotfiles)
fswatch \
  -o \
  --latency 1.0 \
  --exclude '\.DS_Store$' \
  --exclude '\.sw[a-z]$' \
  --exclude '~$' \
  --exclude '/\..*' \
  "$WATCH_DIR" | while read -r _; do
  echo ""
  echo "🔄  Change detected at $(date '+%H:%M:%S') — syncing…"
  "$SCRIPT_DIR/deploy.sh" || echo "⚠️   Sync failed. Will retry on next change."
done
