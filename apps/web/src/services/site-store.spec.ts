// Imported FIRST so the "no side effects on import" test is meaningful.
import { SITE_CACHE_KEY, cachedSite, normalizeSite, siteStore } from './site-store';
import { THEME_CACHE_KEY } from './theme-store';
import { DEFAULT_SITE } from '@24hc/shared';

const html = () => document.documentElement;

function stubSurface(value: string) {
  (window as any).getComputedStyle = () => ({ getPropertyValue: () => value });
}

it('has no side effects on import', () => {
  expect(html().dataset.palette).toBeUndefined();
  expect(window.localStorage.getItem(SITE_CACHE_KEY)).toBeNull();
  expect(window.localStorage.getItem(THEME_CACHE_KEY)).toBeNull();
});

const fetched = {
  theme: { layout: 'rail', palette: 'slate', typeset: 'modern' },
  identity: { name: 'Night School', tagline: 'After dark' },
  registration: { open: false, message: 'Closed.' },
  banner: { enabled: true, text: 'Hello' },
};

describe('site-store', () => {
  beforeEach(() => {
    window.localStorage.clear();
    delete html().dataset.palette;
    delete html().dataset.typeset;
    stubSurface('#fdfcf8');
    (siteStore as any).reset?.();
  });

  describe('normalizeSite', () => {
    it('falls back per field, keeping valid siblings', () => {
      const site = normalizeSite({ identity: { name: 'X' }, registration: { open: 'no' }, banner: 7 });
      expect(site.identity).toEqual({ name: 'X', tagline: null });
      expect(site.registration).toEqual(DEFAULT_SITE.registration);
      expect(site.banner).toEqual(DEFAULT_SITE.banner);
    });

    it('takes its theme from the theme cache when the site entry has none', () => {
      window.localStorage.setItem(THEME_CACHE_KEY, JSON.stringify({ layout: 'rail', palette: 'evening', typeset: 'modern' }));
      expect(normalizeSite({}).theme.layout).toBe('rail');
    });
  });

  describe('cachedSite', () => {
    it('reads the cache and survives a bad entry', () => {
      window.localStorage.setItem(SITE_CACHE_KEY, JSON.stringify(fetched));
      expect(cachedSite().identity.name).toBe('Night School');

      window.localStorage.setItem(SITE_CACHE_KEY, '{nope');
      expect(cachedSite().identity.name).toBe(DEFAULT_SITE.identity.name);
    });
  });

  describe('load', () => {
    it('applies the theme, writes both caches with the applied theme, assigns a new object and emits site:changed', async () => {
      const client = { getSite: jest.fn().mockResolvedValue({ ...fetched, theme: { ...fetched.theme, palette: 'nope' } }) };
      const before = siteStore.config;
      const seen = jest.fn();
      window.addEventListener('site:changed', seen);

      const config = await siteStore.load(client);

      expect(html().dataset.palette).toBe('noon'); // the unknown palette normalised
      expect(config.theme.palette).toBe('noon');
      expect(JSON.parse(window.localStorage.getItem(SITE_CACHE_KEY)!).theme.palette).toBe('noon');
      expect(JSON.parse(window.localStorage.getItem(THEME_CACHE_KEY)!).palette).toBe('noon');
      expect(siteStore.config).not.toBe(before);
      expect(siteStore.config.identity.name).toBe('Night School');
      expect(seen).toHaveBeenCalledTimes(1);
    });

    it('shares one in-flight request between concurrent callers', async () => {
      const client = { getSite: jest.fn().mockResolvedValue(fetched) };
      await Promise.all([siteStore.load(client), siteStore.load(client)]);
      expect(client.getSite).toHaveBeenCalledTimes(1);
    });

    it('rejects when the fetch rejects and leaves the DOM and caches untouched', async () => {
      html().dataset.palette = 'evening';
      const client = { getSite: jest.fn().mockRejectedValue(new Error('down')) };

      await expect(siteStore.load(client)).rejects.toThrow('down');
      expect(html().dataset.palette).toBe('evening');
      expect(window.localStorage.getItem(SITE_CACHE_KEY)).toBeNull();
    });

    it('clears the in-flight slot even when applying the fetched config throws, so the next load retries', async () => {
      (window as any).getComputedStyle = () => { throw new Error('boom'); };
      const client = { getSite: jest.fn().mockResolvedValue(fetched) };

      await expect(siteStore.load(client)).rejects.toThrow('boom');

      stubSurface('#fdfcf8');
      await expect(siteStore.load(client)).resolves.toBeTruthy();
      expect(client.getSite).toHaveBeenCalledTimes(2);
    });
  });
});
