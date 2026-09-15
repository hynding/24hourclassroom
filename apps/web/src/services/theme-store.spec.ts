import { readFileSync } from 'fs';
import { join } from 'path';

// Imported FIRST so the "no side effects on import" test is meaningful: the
// module must not have touched the document by the time we look.
import { THEME_CACHE_KEY, applyTheme, cachedTheme, loadTheme, normalizeTheme, releaseInlineCanvas } from './theme-store';

const html = () => document.documentElement;

function stubSurface(value: string) {
  (window as any).getComputedStyle = () => ({ getPropertyValue: () => value });
}

// Deliberately OUTSIDE the describe with beforeEach, and first in the file:
// the module was evaluated at import, above, and nothing has run since. An
// `applyTheme(cachedTheme())` at module scope would have set data-palette
// and written the cache by now.
it('has no side effects on import', () => {
  expect(html().dataset.palette).toBeUndefined();
  expect(window.localStorage.getItem(THEME_CACHE_KEY)).toBeNull();
});

describe('theme-store', () => {
  beforeEach(() => {
    window.localStorage.clear();
    delete html().dataset.palette;
    delete html().dataset.typeset;
    html().style.colorScheme = '';
    html().style.backgroundColor = '';
    stubSurface('#fdfcf8');
  });

  describe('normalizeTheme', () => {
    it('returns defaults for garbage', () => {
      expect(normalizeTheme(null)).toEqual({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });
      expect(normalizeTheme('x')).toEqual({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });
    });

    it('falls back per field, keeping the valid ones', () => {
      expect(normalizeTheme({ layout: 'rail', palette: 'neon', typeset: 'modern' }))
        .toEqual({ layout: 'rail', palette: 'noon', typeset: 'modern' });
    });
  });

  describe('cachedTheme', () => {
    it('reads and validates the cache', () => {
      window.localStorage.setItem(THEME_CACHE_KEY, JSON.stringify({ layout: 'rail', palette: 'evening', typeset: 'bogus' }));
      expect(cachedTheme()).toEqual({ layout: 'rail', palette: 'evening', typeset: 'editorial' });
    });

    it('returns the default when localStorage throws (private mode)', () => {
      const original = window.localStorage.getItem;
      window.localStorage.getItem = () => { throw new Error('SecurityError'); };
      try {
        expect(cachedTheme()).toEqual({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });
      } finally {
        window.localStorage.getItem = original;
      }
    });
  });

  describe('applyTheme', () => {
    it('writes both attributes even for default values', () => {
      html().dataset.palette = 'evening';
      html().dataset.typeset = 'modern';

      applyTheme({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });

      // If applyTheme skipped defaults, a stale cached `evening` would survive
      // the owner's revert to Noon.
      expect(html().dataset.palette).toBe('noon');
      expect(html().dataset.typeset).toBe('editorial');
    });

    it('caches the APPLIED theme with the palette metadata, not the raw input', () => {
      applyTheme({ layout: 'rail', palette: 'neon', typeset: 'modern' });

      expect(JSON.parse(window.localStorage.getItem(THEME_CACHE_KEY)!)).toEqual({
        layout: 'rail', palette: 'noon', typeset: 'modern', scheme: 'light', surface: '#fdfcf8',
      });
    });

    it('returns the applied theme', () => {
      expect(applyTheme({ layout: 'rail', palette: 'evening', typeset: 'modern' }))
        .toEqual({ layout: 'rail', palette: 'evening', typeset: 'modern' });
    });

    it('clears the inline boot styles once the stylesheet has arrived', () => {
      html().style.colorScheme = 'dark';
      html().style.backgroundColor = '#15191e';

      applyTheme({ layout: 'stacked', palette: 'evening', typeset: 'editorial' });

      expect(html().style.colorScheme).toBe('');
      expect(html().style.backgroundColor).toBe('');
    });

    it('keeps the inline boot styles when the stylesheet is missing', () => {
      stubSurface('');
      html().style.colorScheme = 'dark';
      html().style.backgroundColor = '#15191e';

      applyTheme({ layout: 'stacked', palette: 'evening', typeset: 'editorial' });

      // Clearing here would turn a correctly dark canvas white on a 404'd
      // stylesheet.
      expect(html().style.colorScheme).toBe('dark');
      expect(html().style.backgroundColor).toBe('#15191e');
    });
  });

  describe('releaseInlineCanvas', () => {
    // F6/T8b: direct cases for the extracted function, not just through
    // applyTheme -- app-root's failed-fetch catch calls this without ever
    // reaching applyTheme.
    it('clears color-scheme and background-color once the stylesheet has arrived', () => {
      html().style.colorScheme = 'dark';
      html().style.backgroundColor = '#15191e';

      releaseInlineCanvas();

      expect(html().style.colorScheme).toBe('');
      expect(html().style.backgroundColor).toBe('');
    });

    it('keeps the inline canvas when --color-surface has not resolved', () => {
      stubSurface('');
      html().style.colorScheme = 'dark';
      html().style.backgroundColor = '#15191e';

      releaseInlineCanvas();

      expect(html().style.colorScheme).toBe('dark');
      expect(html().style.backgroundColor).toBe('#15191e');
    });
  });

  describe('loadTheme', () => {
    it('fetches, applies, caches and resolves the applied theme', async () => {
      const client = { getSite: jest.fn().mockResolvedValue({ theme: { layout: 'rail', palette: 'slate', typeset: 'modern' } }) };

      const theme = await loadTheme(client);

      expect(theme).toEqual({ layout: 'rail', palette: 'slate', typeset: 'modern' });
      expect(html().dataset.palette).toBe('slate');
      expect(JSON.parse(window.localStorage.getItem(THEME_CACHE_KEY)!).surface).toBe('#ffffff');
    });

    it('rejects when the fetch rejects and leaves the DOM untouched', async () => {
      html().dataset.palette = 'evening';
      const client = { getSite: jest.fn().mockRejectedValue(new Error('down')) };

      await expect(loadTheme(client)).rejects.toThrow('down');
      expect(html().dataset.palette).toBe('evening');
    });
  });
});

describe('the inline boot script in index.html', () => {
  const html = readFileSync(join(__dirname, '../index.html'), 'utf8');

  it('reads the same cache key the store writes', () => {
    expect(html).toContain(`'${THEME_CACHE_KEY}'`);
  });

  it('runs before the stylesheet link', () => {
    expect(html.indexOf('<script>')).toBeLessThan(html.indexOf('rel="stylesheet"'));
  });

  it('never writes markup', () => {
    expect(html).not.toMatch(/document\.write|innerHTML/);
  });

  it('guards against a cached value that parses but is not an object, so it never writes data-palette="undefined"', () => {
    // F6/T8a: a bare `typeof t === 'object'` also rejects `null`, which is
    // why the guard is written as `t && typeof t === 'object'`, not just
    // `typeof t === 'object'` alone.
    expect(html).toMatch(/typeof t === 'object'/);
  });
});
