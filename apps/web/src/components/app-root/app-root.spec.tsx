import { newSpecPage } from '@stencil/core/testing';

// Every dependency app-root touches at boot is mocked BEFORE the component
// import: jest.mock() is not hoisted under Stencil's TS transpiler.
const cachedTheme = jest.fn();
const loadTheme = jest.fn();
const releaseInlineCanvas = jest.fn();
const navigate = jest.fn();
const authLoad = jest.fn();

jest.mock('../../services/theme-store', () => ({
  cachedTheme: (...a: unknown[]) => cachedTheme(...a),
  loadTheme: (...a: unknown[]) => loadTheme(...a),
  releaseInlineCanvas: (...a: unknown[]) => releaseInlineCanvas(...a),
}));
jest.mock('../../services/auth-store', () => ({
  authStore: { load: (...a: unknown[]) => authLoad(...a), currentUser: null, subscribe: () => () => {} },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));

import { AppRoot } from './app-root';

// app-root reads window.location.pathname at field initialisation, before
// connectedCallback, so the path must be set before mount.
//
// A plain `window.history.replaceState({}, '', path)` here does not survive:
// newSpecPage()'s first step is resetPlatform(), which unconditionally
// resets win.location.href to the testing origin (mock-doc's
// history.replaceState is also a no-op stub, so it would not have stuck
// either). newSpecPage's own `url` option is applied *after* that reset --
// it is the supported way to control the initial location of a spec page --
// so route through it instead of a pre-mount replaceState call.
const mountAt = async (path: string) => {
  return newSpecPage({
    components: [AppRoot],
    html: '<app-root></app-root>',
    url: `http://testing.stenciljs.com${path}`,
  });
};

let resolveLoad: (t: unknown) => void;
let rejectLoad: (e: unknown) => void;

describe('app-root theme wiring', () => {
  beforeEach(() => {
    cachedTheme.mockReset().mockReturnValue({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });
    loadTheme.mockReset().mockImplementation(() => new Promise((res, rej) => { resolveLoad = res; rejectLoad = rej; }));
    releaseInlineCanvas.mockReset();
    navigate.mockReset();
    authLoad.mockReset().mockResolvedValue(null);
  });

  it('renders the cached layout on the first frame', async () => {
    cachedTheme.mockReturnValue({ layout: 'rail', palette: 'noon', typeset: 'editorial' });
    const spec = await mountAt('/teachers');

    const layout = spec.root.shadowRoot.querySelector('app-layout')!;
    expect(layout.getAttribute('layout')).toBe('rail');
    expect(layout.getAttribute('layout')).not.toBe('stacked');
    expect(spec.root.shadowRoot.querySelector('app-header')!.getAttribute('orientation')).toBe('vertical');
  });

  it('switches layout when the fetch lands, keeping the same header instance', async () => {
    const spec = await mountAt('/teachers');
    const layout = spec.root.shadowRoot.querySelector('app-layout')!;
    const headerBefore = spec.root.shadowRoot.querySelector('app-header');
    expect(layout.getAttribute('layout')).toBe('stacked');

    resolveLoad({ layout: 'rail', palette: 'evening', typeset: 'modern' });
    // Two ticks: one for the .then() microtask that assigns this.layout,
    // one for Stencil to flush the render it schedules.
    await spec.waitForChanges();
    await spec.waitForChanges();

    expect(layout.getAttribute('layout')).toBe('rail');
    // Identity, not presence: a regression to per-layout wrapper tags would
    // re-create the header (and re-fire its subscriptions) -- only observable
    // from here, since the children are app-root's light DOM.
    expect(spec.root.shadowRoot.querySelector('app-header')).toBe(headerBefore);
    expect(spec.root.shadowRoot.querySelector('app-header')!.getAttribute('orientation')).toBe('vertical');
  });

  it('keeps the cached layout and does not throw when the fetch fails', async () => {
    cachedTheme.mockReturnValue({ layout: 'rail', palette: 'noon', typeset: 'editorial' });
    const spec = await mountAt('/teachers');

    rejectLoad(new Error('down'));
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.querySelector('app-layout')!.getAttribute('layout')).toBe('rail');
  });

  it('releases the inline boot canvas when the fetch fails', async () => {
    // F6/T8b: a failed loadTheme() never reaches applyTheme, so nothing else
    // would hand the boot script's inline canvas back to the stylesheet.
    const spec = await mountAt('/teachers');

    rejectLoad(new Error('down'));
    await spec.waitForChanges();

    expect(releaseInlineCanvas).toHaveBeenCalledTimes(1);
  });

  it('does not release the inline canvas on the resolution path -- applyTheme owns that', async () => {
    const spec = await mountAt('/teachers');

    resolveLoad({ layout: 'rail', palette: 'evening', typeset: 'modern' });
    await spec.waitForChanges();
    await spec.waitForChanges();

    expect(releaseInlineCanvas).not.toHaveBeenCalled();
  });

  it('calls auth-store.load and applies guards without waiting on the theme fetch', async () => {
    // F7/T11: loadTheme is left pending for the whole test (the default
    // beforeEach mock, which never resolves or rejects). The real hazard of
    // an accidental `await loadTheme()` in connectedCallback is that
    // authStore.load() and applyGuards() would be deferred behind it, so a
    // hanging /api/site would render every visitor as a signed-out guest
    // with route guards never applied.
    await mountAt('/profile');

    expect(authLoad).toHaveBeenCalledTimes(1);
    expect(navigate).toHaveBeenCalledWith('/login');
  });

  it('slots the page inside app-layout, not beside it', async () => {
    const spec = await mountAt('/teachers');
    const layout = spec.root.shadowRoot.querySelector('app-layout')!;
    expect(layout.querySelector('page-teachers')).not.toBeNull();
    expect(layout.querySelector('app-header')!.getAttribute('slot')).toBe('header');
    expect(layout.querySelector('app-footer')!.getAttribute('slot')).toBe('footer');
  });

  it('mounts the print page bare and every other page with chrome', async () => {
    cachedTheme.mockReturnValue({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });
    loadTheme.mockResolvedValue({ layout: 'stacked', palette: 'noon', typeset: 'editorial' });
    authLoad.mockResolvedValue(undefined);

    const print = await mountAt('/tests/3/print');
    expect(print.root.shadowRoot.querySelector('app-layout').hasAttribute('bare')).toBe(true);
    expect(print.root.shadowRoot.querySelector('page-test-print')).not.toBeNull();

    const tests = await mountAt('/tests');
    expect(tests.root.shadowRoot.querySelector('app-layout').hasAttribute('bare')).toBe(false);
    expect(tests.root.shadowRoot.querySelector('page-tests')).not.toBeNull();
  });

  // The child page tags are not registered in these spec pages, so Stencil
  // may hand the value over as a property or as an attribute depending on
  // the element; read whichever landed rather than pinning the mechanism.
  const propOf = (el: Element | null, camel: string, dashed: string) => {
    const value = (el as any)?.[camel] ?? el?.getAttribute(camel.toLowerCase()) ?? el?.getAttribute(dashed);
    return value == null ? null : String(value);
  };

  it('mounts the materials list page', async () => {
    const spec = await mountAt('/materials');
    expect(spec.root.shadowRoot.querySelector('page-materials')).not.toBeNull();
  });

  it('passes the material id to the single-material, form and share pages', async () => {
    const view = await mountAt('/materials/7');
    expect(propOf(view.root.shadowRoot.querySelector('page-material'), 'materialId', 'material-id')).toBe('7');

    const edit = await mountAt('/materials/7/edit');
    expect(propOf(edit.root.shadowRoot.querySelector('page-material-form'), 'materialId', 'material-id')).toBe('7');

    const share = await mountAt('/materials/7/share');
    expect(propOf(share.root.shadowRoot.querySelector('page-material-share'), 'materialId', 'material-id')).toBe('7');
  });

});
