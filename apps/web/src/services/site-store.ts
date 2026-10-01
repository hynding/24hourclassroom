import { ApiClient } from '@24hc/api-client';
import { DEFAULT_SITE, type SiteConfig } from '@24hc/shared';
import { Env } from '@stencil/core';
import { applyTheme, cachedTheme, normalizeTheme } from './theme-store';

/**
 * The whole /api/site config, cached beside the theme cache so the wordmark,
 * footer, title, hero and banner are right on the first frame. Versioning
 * rule as for THEME_CACHE_KEY: bump the suffix on ANY change to the cached
 * shape; unknown keys are ignored by normalisation.
 */
export const SITE_CACHE_KEY = '24hc.site.v1';

// No module-scope side effects: constructing a client is fine (auth-store
// does the same); touching document/localStorage/network at import is not.
const defaultClient = new ApiClient({ baseUrl: Env?.apiBaseUrl ?? 'http://localhost:8000' });

const str = (v: unknown): string | null => (typeof v === 'string' && v !== '' ? v : null);
const obj = (v: unknown): Record<string, unknown> => (v && typeof v === 'object' ? (v as Record<string, unknown>) : {});

/** Per-field fallback to DEFAULT_SITE; the theme falls back to the theme cache, not the default, so a pre-release visitor keeps their layout. */
export function normalizeSite(input: unknown): SiteConfig {
  const raw = obj(input);
  const identity = obj(raw.identity);
  const registration = obj(raw.registration);
  const banner = obj(raw.banner);
  return {
    theme: raw.theme === undefined ? cachedTheme() : normalizeTheme(raw.theme),
    identity: { name: str(identity.name) ?? DEFAULT_SITE.identity.name, tagline: str(identity.tagline) },
    registration: {
      open: typeof registration.open === 'boolean' ? registration.open : DEFAULT_SITE.registration.open,
      message: str(registration.message),
    },
    banner: {
      enabled: typeof banner.enabled === 'boolean' ? banner.enabled : DEFAULT_SITE.banner.enabled,
      text: str(banner.text),
    },
  };
}

export function cachedSite(): SiteConfig {
  try {
    const raw = window.localStorage.getItem(SITE_CACHE_KEY);
    return normalizeSite(raw ? JSON.parse(raw) : {});
  } catch {
    return normalizeSite({});
  }
}

export class SiteStore {
  private current: SiteConfig | null = null;
  private inFlight: Promise<SiteConfig> | null = null;

  /** Lazy: the first read hydrates from the cache, so nothing touches localStorage at import. */
  get config(): SiteConfig {
    return (this.current ??= cachedSite());
  }

  /** Fetches once per concurrent burst; applies the theme (which writes the theme cache), then caches the whole config with the APPLIED theme, then announces. */
  load(client: Pick<ApiClient, 'getSite'> = defaultClient): Promise<SiteConfig> {
    if (!this.inFlight) {
      this.inFlight = client
        .getSite()
        .then((fetched) => {
          const theme = applyTheme(fetched.theme);
          const config: SiteConfig = { ...normalizeSite(fetched), theme };
          try {
            window.localStorage.setItem(SITE_CACHE_KEY, JSON.stringify(config));
          } catch {
            // Private mode: the config still applies, it just won't be remembered.
          }
          this.current = config; // a new object, so @State snapshots see a changed reference
          window.dispatchEvent(new CustomEvent('site:changed'));
          return config;
        })
        .finally(() => {
          // Always cleared -- a throw inside the handler above must not wedge the store.
          this.inFlight = null;
        });
    }
    return this.inFlight;
  }

  /** Test seam: forget the hydrated config so a spec starts cold. */
  reset(): void {
    this.current = null;
    this.inFlight = null;
  }
}

export const siteStore = new SiteStore();
