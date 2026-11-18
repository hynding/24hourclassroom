// Accessibility audit of the built SPA (www/), API mocked by fixtures.cjs.
//
//   npm run build && npm run a11y -w @24hc/web
//
// Serves www/ with an index.html fallback, opens each page below as a guest,
// a student and a teacher, in every palette and both layouts, at desktop and
// phone width, and runs axe-core (WCAG 2.1 A/AA plus best practice) through
// every open shadow root. Any violation fails the run. Env: PAGES (comma
// list of paths), PALETTES, LAYOUTS, WIDTHS to narrow it while debugging.
const http = require('http');
const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');
const fixtures = require('./fixtures.cjs');

const WWW = path.join(__dirname, '..', 'www');
const AXE = fs.readFileSync(require.resolve('axe-core/axe.min.js'), 'utf8');
const PORT = 4555;

const PAGES = [
  ['guest', '/'], ['guest', '/library/courses'], ['guest', '/library/tests'], ['guest', '/library/materials'],
  ['guest', '/courses/3'], ['guest', '/courses/3/tests/9'], ['guest', '/materials/1'], ['guest', '/teachers'],
  ['guest', '/teachers/1'], ['guest', '/login'], ['guest', '/register'], ['guest', '/forgot-password'],
  ['student', '/'], ['student', '/courses/3'], ['student', '/courses/3/tests/9'], ['student', '/tests'],
  ['student', '/materials/1'], ['student', '/materials/2'], ['guest', '/materials/2'], ['student', '/profile'], ['student', '/connections'], ['student', '/notifications'],
  ['teacher', '/tests'], ['teacher', '/tests/9'], ['teacher', '/tests/new'], ['teacher', '/materials'],
  ['teacher', '/materials/new'], ['teacher', '/courses'], ['teacher', '/courses/new'], ['teacher', '/integrations'],
  ['teacher', '/grading'],
];
const list = (name, fallback) => (process.env[name] || fallback).split(',').filter(Boolean);
const only = list('PAGES', '');
// Two palettes by default (light and dark): theme-files.spec.ts already holds
// every palette's text tokens to 4.5:1. PALETTES=noon,evening,slate,afternoon for all.
const PALETTES = list('PALETTES', 'noon,evening');
const LAYOUTS = list('LAYOUTS', 'rail,stacked');
const WIDTHS = list('WIDTHS', '1280,390').map(Number);

/**
 * The skip link sits outside every landmark on purpose (it must come first),
 * and axe cannot follow its #main into a shadow root to exempt it.
 */
const allowed = (violation, node) => violation.id === 'region' && node.html.startsWith('<a class="skip"');

const TYPES = { '.js': 'text/javascript', '.css': 'text/css', '.html': 'text/html', '.svg': 'image/svg+xml', '.png': 'image/png', '.woff2': 'font/woff2', '.json': 'application/json' };
const server = http.createServer((req, res) => {
  let file = path.join(WWW, decodeURIComponent(req.url.split('?')[0]));
  if (!file.startsWith(WWW) || !fs.existsSync(file) || fs.statSync(file).isDirectory()) {
    file = path.join(WWW, 'index.html');
  }
  res.writeHead(200, { 'content-type': TYPES[path.extname(file)] || 'application/octet-stream' });
  fs.createReadStream(file).pipe(res);
});

(async () => {
  if (!fs.existsSync(path.join(WWW, 'index.html'))) {
    console.error('No www/index.html: run `npm run build` first.');
    process.exit(2);
  }
  await new Promise((resolve) => server.listen(PORT, resolve));
  const browser = await chromium.launch();
  const failures = [];
  let runs = 0;
  for (const width of WIDTHS) for (const palette of PALETTES) for (const layout of LAYOUTS) for (const [who, url] of PAGES) {
    if (only.length && !only.includes(url)) {
      continue;
    }
    const context = await browser.newContext({ viewport: { width, height: 900 } });
    const page = await context.newPage();
    const errors = [];
    page.on('pageerror', (e) => errors.push(e.message));
    await page.route('http://localhost:8000/**', (route) => fixtures.respond(route, who, { palette, layout }));
    await page.goto(`http://localhost:${PORT}${url}`);
    // Pages fetch after mount; wait for the network to settle, then a beat for the render.
    await page.waitForLoadState('networkidle');
    await page.waitForTimeout(300);
    await page.addScriptTag({ content: AXE });
    const violations = await page.evaluate(async () => {
      const result = await window.axe.run(document, { runOnly: { type: 'tag', values: ['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa', 'best-practice'] } });
      return result.violations.map((v) => ({ id: v.id, impact: v.impact, help: v.help, nodes: v.nodes.map((n) => ({ target: n.target, html: n.html.slice(0, 200), summary: n.failureSummary })) }));
    });
    runs++;
    const where = `${who} ${url} (${palette}, ${layout}, ${width}px)`;
    for (const message of errors) {
      failures.push(`${where}: page error: ${message}`);
    }
    for (const v of violations) {
      for (const n of v.nodes.filter((node) => !allowed(v, node))) {
        failures.push(`${where}: ${v.id} (${v.impact}) ${v.help}\n    ${JSON.stringify(n.target)} ${n.html}\n    ${n.summary.replace(/\n/g, '\n    ')}`);
      }
    }
    await context.close();
  }
  await browser.close();
  server.close();
  if (failures.length) {
    console.error(failures.join('\n\n'));
    console.error(`\n${failures.length} accessibility problem(s) in ${runs} page runs.`);
    process.exit(1);
  }
  console.log(`No accessibility problems in ${runs} page runs.`);
})().catch((e) => {
  console.error(e);
  process.exit(1);
});
