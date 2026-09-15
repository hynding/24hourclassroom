import { newSpecPage } from '@stencil/core/testing';

// Every dependency app-root touches at boot is mocked BEFORE the component
// import: jest.mock() is not hoisted under Stencil's TS transpiler.
const cachedTheme = jest.fn();
const loadTheme = jest.fn();
const navigate = jest.fn();

jest.mock('../../services/theme-store', () => ({
  cachedTheme: (...a: unknown[]) => cachedTheme(...a),
  loadTheme: (...a: unknown[]) => loadTheme(...a),
}));
jest.mock('../../services/auth-store', () => ({
  authStore: { load: jest.fn().mockResolvedValue(null), currentUser: null, subscribe: () => () => {} },
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
    navigate.mockReset();
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

  it('slots the page inside app-layout, not beside it', async () => {
    const spec = await mountAt('/teachers');
    const layout = spec.root.shadowRoot.querySelector('app-layout')!;
    expect(layout.querySelector('page-teachers')).not.toBeNull();
    expect(layout.querySelector('app-header')!.getAttribute('slot')).toBe('header');
    expect(layout.querySelector('app-footer')!.getAttribute('slot')).toBe('footer');
  });
});
