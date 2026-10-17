// eslint-disable-next-line @typescript-eslint/no-var-requires
const { robotsTxt, DISALLOW } = require('../../scripts/robots.js');
import { isIndexable } from '../services/router';

describe('robots.txt', () => {
  it('points at the API host\'s sitemap', () => {
    expect(robotsTxt('https://api.example.org/')).toContain('Sitemap: https://api.example.org/api/sitemap.xml');
  });

  it('never disallows a page the SPA lets search engines index', () => {
    const indexable = ['/', '/library', '/teachers', '/teachers/3', '/courses/7', '/courses/7/tests/9', '/tests/9', '/materials/2'];
    for (const path of indexable) {
      expect(isIndexable(path)).toBe(true);
      expect(DISALLOW.some((prefix: string) => path.startsWith(prefix))).toBe(false);
    }
  });
});
