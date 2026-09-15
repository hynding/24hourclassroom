import { ApiClient } from '@24hc/api-client';
import {
  DEFAULT_THEME,
  LAYOUTS,
  PALETTES,
  TYPESETS,
  type Layout,
  type Palette,
  type SiteTheme,
  type Typeset,
} from '@24hc/shared';
import { Env } from '@stencil/core';

/**
 * Versioning rule: bump the suffix on ANY change to the cached fields or
 * their meaning; a missing, malformed or wrong-version entry reads as absent.
 * The inline boot script in index.html reads this same literal -- a spec
 * asserts the two agree.
 */
export const THEME_CACHE_KEY = '24hc.theme.v1';

// No module-scope side effects: constructing a client is fine (auth-store
// does the same); touching document/localStorage/network at import is not.
const defaultClient = new ApiClient({ baseUrl: Env?.apiBaseUrl ?? 'http://localhost:8000' });

const isLayout = (v: unknown): v is Layout => LAYOUTS.some((o) => o.value === v);
const isPalette = (v: unknown): v is Palette => PALETTES.some((o) => o.value === v);
const isTypeset = (v: unknown): v is Typeset => TYPESETS.some((o) => o.value === v);

/** Per-field fallback: an unknown palette must not discard a valid layout. */
export function normalizeTheme(input: unknown): SiteTheme {
  const raw = (input ?? {}) as Record<string, unknown>;
  return {
    layout: isLayout(raw.layout) ? raw.layout : DEFAULT_THEME.layout,
    palette: isPalette(raw.palette) ? raw.palette : DEFAULT_THEME.palette,
    typeset: isTypeset(raw.typeset) ? raw.typeset : DEFAULT_THEME.typeset,
  };
}

export function cachedTheme(): SiteTheme {
  try {
    // window.-prefixed: bare globals are not guaranteed in Stencil's Jest env.
    const raw = window.localStorage.getItem(THEME_CACHE_KEY);
    return normalizeTheme(raw ? JSON.parse(raw) : null);
  } catch {
    // localStorage throws in some private-browsing modes; a throw here would
    // surface as Stencil's console.error from app-root's componentWillLoad.
    return { ...DEFAULT_THEME };
  }
}

export function applyTheme(input: unknown): SiteTheme {
  const theme = normalizeTheme(input);
  const root = document.documentElement;

  // Always write both, default values included, or a stale cached palette
  // would survive the owner's revert to the default.
  root.dataset.palette = theme.palette;
  root.dataset.typeset = theme.typeset;

  const meta = PALETTES.find((o) => o.value === theme.palette)!;
  try {
    window.localStorage.setItem(THEME_CACHE_KEY, JSON.stringify({ ...theme, scheme: meta.scheme, surface: meta.surface }));
  } catch {
    // Private mode: the theme still applies, it just won't be remembered.
  }

  // The boot script painted the canvas inline before any CSS existed. Hand it
  // back to the stylesheet only once the stylesheet has actually arrived; if
  // app.css 404'd, clearing would turn a correctly dark canvas white.
  if (window.getComputedStyle(root).getPropertyValue('--color-surface').trim() !== '') {
    root.style.removeProperty('color-scheme');
    root.style.removeProperty('background-color');
  }

  return theme;
}

export async function loadTheme(client: Pick<ApiClient, 'getSite'> = defaultClient): Promise<SiteTheme> {
  const config = await client.getSite();
  return applyTheme(config.theme);
}
