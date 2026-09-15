---
name: run-local
description: Launch and drive the 24 Hour Classroom app locally — Stencil dev server, optional Laravel API, and the browser recipe for inspecting themes, palettes, layouts, and anything inside a shadow root. Use this whenever you need to see a change actually rendering rather than just passing tests: "run the app", "start the dev server", "screenshot the homepage", "check how the rail layout looks", "does Slate render correctly", "is this CSS actually applying". Also use it before claiming any visual change works.
---

# Running 24 Hour Classroom locally

Tests here are good but they check computed values, not pixels. Several classes
of bug in this repo are invisible to them — a stylesheet that was never linked,
a `@Prop` that doesn't reflect, a palette whose contrast is fine but whose
result looks wrong. Rendering it is the only way to see those.

## Pick the smallest thing that answers the question

**Web only** — right for anything visual. The API is not needed to render pages,
apply themes, or check layouts.

```bash
npm run dev -w @24hc/web    # http://localhost:3333
```

**Full stack** — needed only when you must sign in, hit a real endpoint, or
exercise data from the database.

```bash
docker compose --profile localdb up --build   # bundled MySQL
docker compose up --build                     # bring your own DB
```

Web on `:3333`, API on `:8000` (health check at `/up`).

### Before the first run on a fresh clone

`apps/web` imports `@24hc/shared` and `@24hc/api-client` from their `dist/`
output, which is gitignored. Build once, in dependency order:

```bash
npm run build
```

Skipping this produces module-resolution errors that look like a broken dev
server rather than a missing build.

### Expect these console errors without the API

```
ERR_CONNECTION_REFUSED  http://localhost:8000/api/site
ERR_CONNECTION_REFUSED  http://localhost:8000/api/user
```

They are correct behaviour, not a failure. `/api/site` failing hands the page to
the default Noon tokens and releases the pre-paint boot canvas — so seeing the
page render normally here is a live check of the failed-fetch path. Only
investigate if the page renders *unstyled* or blank.

## Waiting for the server

Don't sleep in the foreground. Poll until it answers, in the background:

```bash
for i in $(seq 1 120); do
  curl -sf -o /dev/null http://localhost:3333/ && { echo "UP after ${i}s"; exit 0; }
  sleep 1
done; echo TIMEOUT; exit 1
```

A cold Stencil dev build is ~2s, so this usually returns on the first tick.

## Shutting it down

Use `TaskStop` with the background task id. Killing the PID on port 3333
directly does **not** reliably stop it — Stencil's watcher respawns and the port
stays bound. Verify with `lsof -ti:3333` and expect no output.

## Driving it in a browser

Use the Playwright MCP tools. Two constraints worth knowing up front:

**Screenshots must land in `.playwright-mcp/`** — it is the only writable root
for that tool in this repo, and it is gitignored (one stale `page-*.yml` from
before that rule is still tracked; leave it). Delete your screenshots when
you're done so the working tree stays clean.

**Everything is inside a shadow root.** `document.querySelector('app-layout')`
returns `null`. The real tree is:

```
<app-root> [shadow]
  <app-layout layout="stacked"> [shadow]
    <app-header orientation="horizontal" slot="header"> [shadow]
    <page-*> [shadow]
    <app-footer slot="footer"> [shadow]
```

### Changing the theme without the API

Palettes and typesets are pure CSS keyed on attributes on `<html>`, so setting
them directly exercises exactly the path `applyTheme` uses. This is how to look
at a palette that the running API wouldn't serve you:

```js
const root = document.documentElement;
root.dataset.palette = 'slate';      // noon | evening | slate | afternoon
root.dataset.typeset = 'editorial';  // editorial | modern
// applyTheme also clears these inline boot-script styles:
root.style.removeProperty('color-scheme');
root.style.removeProperty('background-color');
```

Layout and header orientation are props on elements inside `app-root`'s shadow
root, and they only work because those props are `reflect: true`:

```js
const sr = document.querySelector('app-root').shadowRoot;
sr.querySelector('app-layout').setAttribute('layout', 'rail');        // stacked | rail
sr.querySelector('app-header').setAttribute('orientation', 'vertical');
```

### Confirm what actually resolved

A screenshot alone can't tell you whether a token resolved or silently fell back
to the `:root` default. Read the computed values too:

```js
const cs = getComputedStyle(document.documentElement);
['--color-surface','--color-ink','--color-accent','--font-body']
  .forEach(n => console.log(n, cs.getPropertyValue(n).trim()));
getComputedStyle(document.body).backgroundColor;
```

If a palette's values come back identical to Noon's, the selector didn't match —
check that it is exactly `:root[data-palette='<name>']`.

## Look at the screenshot

Read the image back, don't just save it. A blank or unstyled frame is the
signal that matters most here, and it looks like success in the tool result.
Unstyled means Times New Roman, `#0000EE` links, no margins — that is what this
app looks like when `app.css` isn't reaching the page.
