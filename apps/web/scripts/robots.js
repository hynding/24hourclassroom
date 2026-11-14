// Writes www/robots.txt after `stencil build`. Generated rather than copied
// because the sitemap lives on the API host (only the API can see which
// courses are public) and that host is known only at build time, from the
// same API_BASE_URL the bundle is built with.
const fs = require('fs');
const path = require('path');

// Account and form pages: noindex already, and not worth crawl budget.
// Prefixes only where nothing public shares them ('/tests' would block
// every public test).
const DISALLOW = [
  '/login', '/register', '/forgot-password', '/reset-password', '/verify-email',
  '/profile', '/connections', '/notifications', '/integrations',
  '/attempts/', '/generations/', '/students/',
];

function robotsTxt(apiBaseUrl) {
  const base = String(apiBaseUrl).replace(/\/+$/, '');
  return ['User-agent: *', ...DISALLOW.map((p) => `Disallow: ${p}`), '', `Sitemap: ${base}/api/sitemap.xml`, ''].join('\n');
}

module.exports = { robotsTxt, DISALLOW };

if (require.main === module) {
  const out = path.join(__dirname, '..', 'www', 'robots.txt');
  fs.writeFileSync(out, robotsTxt(process.env.API_BASE_URL ?? 'http://localhost:8000'));
}
