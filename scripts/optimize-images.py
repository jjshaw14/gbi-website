#!/usr/bin/env python3
"""
Shrink the image library in place, conservatively.

The site ships 133 MB of images. Nine are straight off a phone at 4032x3024
or 5712x4284 -- several times larger than any display they reach. This
resizes those down and re-encodes, keeping filenames unchanged so no page
reference has to move.

Rules
-----
- Max width 2560px. That still covers a 1440px container on a 2x display.
- MPO files (iPhone multi-picture JPEGs, which arrive named .jpg) are
  re-saved as plain JPEG. These are the biggest files in the library.
- JPEG re-encoded at quality 85, progressive, EXIF stripped, ICC preserved
  so colours do not shift.
- PNG kept as PNG (many carry transparency) and re-saved with optimize.
- A file is only overwritten if the result is actually smaller. Re-encoding
  an already-tight JPEG can grow it; that case is skipped.

Usage
-----
    python scripts/optimize-images.py <dir> [--apply]

Without --apply it reports what it would do and writes nothing.
"""
from __future__ import annotations

import io
import sys
from pathlib import Path
from PIL import Image

MAX_WIDTH = 2560
JPEG_QUALITY = 85

def process(path: Path, apply: bool):
    # Read into memory first. Opening the Path directly leaves a file handle
    # open on Windows, and os.replace() then fails with "Access is denied"
    # partway through the run.
    raw = path.read_bytes()
    before = len(raw)
    try:
        im = Image.open(io.BytesIO(raw))
        im.load()
    except Exception as exc:
        return ("skip", before, before, f"unreadable: {exc}")

    fmt = (im.format or "").upper()
    # MPO is what an iPhone writes for some photos: a JPEG container holding a
    # second embedded image the web never uses. They arrive here as .jpg and
    # are the largest files in the library, so treat them as JPEG and re-save
    # as plain JPEG, which also drops the unused frame.
    if fmt == "MPO":
        fmt = "JPEG"
    if fmt not in ("JPEG", "PNG"):
        return ("skip", before, before, f"format {fmt}")

    icc = im.info.get("icc_profile")
    resized = False
    if im.width > MAX_WIDTH:
        h = round(im.height * MAX_WIDTH / im.width)
        im = im.resize((MAX_WIDTH, h), Image.LANCZOS)
        resized = True

    tmp = path.with_suffix(path.suffix + ".opt")
    try:
        if fmt == "JPEG":
            if im.mode not in ("RGB", "L"):
                im = im.convert("RGB")
            im.save(tmp, "JPEG", quality=JPEG_QUALITY, optimize=True,
                    progressive=True, **({"icc_profile": icc} if icc else {}))
        else:
            im.save(tmp, "PNG", optimize=True,
                    **({"icc_profile": icc} if icc else {}))
    except Exception as exc:
        tmp.unlink(missing_ok=True)
        return ("skip", before, before, f"encode failed: {exc}")

    after = tmp.stat().st_size
    if after >= before:
        tmp.unlink(missing_ok=True)
        return ("keep", before, before, "re-encode was not smaller")

    if apply:
        tmp.replace(path)
    else:
        tmp.unlink(missing_ok=True)
    return ("resize+recode" if resized else "recode", before, after, "")


def main():
    if len(sys.argv) < 2:
        sys.exit("Usage: optimize-images.py <dir> [--apply]")
    root = Path(sys.argv[1])
    apply = "--apply" in sys.argv

    files = sorted(p for p in root.rglob("*")
                   if p.suffix.lower() in (".jpg", ".jpeg", ".png"))
    tb = ta = 0
    changed = []
    for p in files:
        action, before, after, note = process(p, apply)
        tb += before
        ta += after
        if action in ("resize+recode", "recode"):
            changed.append((before - after, action, p))

    changed.sort(reverse=True)
    print(f"{'APPLIED' if apply else 'DRY RUN'}: {len(files)} images scanned, "
          f"{len(changed)} would shrink\n")
    print("BIGGEST SAVINGS:")
    for saved, action, p in changed[:12]:
        print(f"  -{saved/1048576:5.2f}MB  {action:14} {p.name}")
    print(f"\n  before: {tb/1048576:7.1f} MB")
    print(f"  after:  {ta/1048576:7.1f} MB")
    print(f"  saved:  {(tb-ta)/1048576:7.1f} MB  ({(tb-ta)/tb*100:.0f}%)")
    if not apply:
        print("\nNothing written. Re-run with --apply to commit the changes.")


if __name__ == "__main__":
    main()
