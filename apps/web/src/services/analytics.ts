import { Env } from '@stencil/core';

/**
 * Cookieless page-view counting (App\Support\Metrics on the API). What is
 * sent: the page's path, and on the first page of a tab also whether it is
 * that first page, the referring address (the API keeps only its site) and
 * `utm_source`. Never a cookie, an identifier or the query string: the
 * request goes with credentials omitted, so even a signed-in visitor is
 * counted anonymously. Nothing is sent under Do Not Track or Global Privacy
 * Control, or from an automated browser.
 */

const VISIT_KEY = '24hc.visit.v1';
/** Long enough for a vanity or id path to settle on its canonical address. */
const SETTLE_MS = 1500;

let timer: ReturnType<typeof setTimeout> | undefined;
let lastPath: string | undefined;

export function optedOut(nav: Navigator = navigator): boolean {
  const n = nav as Navigator & { globalPrivacyControl?: boolean; msDoNotTrack?: string };
  return n.webdriver === true || n.globalPrivacyControl === true || n.doNotTrack === '1' || n.msDoNotTrack === '1';
}

/** True only for the first page counted in this tab; sessionStorage never leaves the browser. */
function firstInTab(): boolean {
  try {
    if (sessionStorage.getItem(VISIT_KEY)) {
      return false;
    }
    sessionStorage.setItem(VISIT_KEY, '1');
    return true;
  } catch {
    return false;
  }
}

function send(): void {
  if (typeof fetch !== 'function') {
    return;
  }
  const path = window.location.pathname;
  if (path === lastPath) {
    return;
  }
  lastPath = path;
  const body: Record<string, unknown> = { path };
  if (firstInTab()) {
    body.visit = true;
    if (document.referrer) {
      body.referrer = document.referrer;
    }
    const source = new URLSearchParams(window.location.search).get('utm_source');
    if (source) {
      body.source = source;
    }
  }
  const api = (Env?.apiBaseUrl ?? 'http://localhost:8000').replace(/\/+$/, '');
  fetch(`${api}/api/analytics/view`, {
    method: 'POST',
    credentials: 'omit',
    keepalive: true,
    headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
    body: JSON.stringify(body),
  }).catch(() => undefined);
}

/** Count the page the browser settles on after a navigation. */
export function trackPageView(): void {
  if (optedOut()) {
    return;
  }
  clearTimeout(timer);
  timer = setTimeout(send, SETTLE_MS);
}

/** Test seam. */
export function resetAnalyticsForTests(): void {
  clearTimeout(timer);
  timer = undefined;
  lastPath = undefined;
}
