/**
 * Puts a page's canonical address (a course or teacher's slug path) in the
 * address bar without a new history entry or a re-route: the page already
 * shows what it names. Call before setPageMeta, which only describes the
 * path the browser is on.
 */
export function adoptCanonicalPath(path: string, from?: string): void {
  // `from`: only while the browser is still on the id path this page was
  // opened at; a late load for a page already left changes nothing.
  if (from !== undefined && window.location.pathname.replace(/\/+$/, '') !== from) {
    return;
  }
  if (path !== window.location.pathname) {
    history.replaceState(history.state, '', `${path}${window.location.search}${window.location.hash}`);
  }
}

export function navigate(path: string): void {
  history.pushState({}, '', path);
  window.dispatchEvent(new PopStateEvent('popstate'));
}
