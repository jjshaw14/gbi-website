# GBI Website — Quick Reference

## Start auto-sync (do this first each session)

```
cd ~/Documents/Claude/Projects/GBI\ Website && ./deploy-watch.sh
```

Leave that terminal window open in the background. Every file save auto-syncs to Cloudways within ~2 seconds.

## Force a one-shot sync (if watcher isn't running)

```
cd ~/Documents/Claude/Projects/GBI\ Website && ./deploy.sh
```

## Force-refresh a specific file (if watcher missed something)

```
cd ~/Documents/Claude/Projects/GBI\ Website && touch site/assets/css/styles.css && ./deploy.sh
```

Replace the file path with whatever needs to re-upload.

## URLs

- **Staging site:** https://phpstack-163463-6478255.cloudwaysapps.com/
- **Local site folder:** `~/Documents/Claude/Projects/GBI Website/site/`
- **Content handoff (Bradford's files, spreadsheets, images):** `~/Documents/Claude/Projects/GBI Website/content-handoff/`
- **Archived pages (recoverable):** `~/Documents/Claude/Projects/GBI Website/_archive/`

## Browser cache tips

- Hard-refresh: **Cmd + Shift + R**
- If a CSS/JS change isn't showing, add a cache buster to the URL: `?v=whatever`
- Or open in Incognito to bypass cache entirely
