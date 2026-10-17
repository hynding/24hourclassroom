/**
 * Where to send a visitor once they have signed in, when they left a page
 * to do it: a guest who taps "Sign up free" on a public course should land
 * back on that course, not on the home page.
 *
 * localStorage, not sessionStorage: email verification opens the link in a
 * new tab. Every way in ends on `/` (login, Google sign-in, the role
 * picker, the verification link), so app-root consumes it there, once.
 * Expires so a sign-up abandoned today cannot redirect a login next week.
 */
export const RETURN_PATH_KEY = '24hc.return.v1';

const TTL_MS = 24 * 60 * 60 * 1000;

/** Allowlist: only a course page is a return target. */
const ALLOWED = /^\/courses\/\d+$/;

export function rememberReturnPath(path: string, now = Date.now()): void {
  if (!ALLOWED.test(path)) {
    return;
  }
  try {
    window.localStorage.setItem(RETURN_PATH_KEY, JSON.stringify({ path, at: now }));
  } catch {
    // Private mode: they land on the home page instead.
  }
}

/** The remembered path, removed as it is read; null when none, stale or malformed. */
export function takeReturnPath(now = Date.now()): string | null {
  try {
    const raw = window.localStorage.getItem(RETURN_PATH_KEY);
    if (raw === null) {
      return null;
    }
    window.localStorage.removeItem(RETURN_PATH_KEY);
    const { path, at } = JSON.parse(raw) ?? {};
    return typeof path === 'string' && ALLOWED.test(path) && typeof at === 'number' && now - at >= 0 && now - at < TTL_MS ? path : null;
  } catch {
    return null;
  }
}
