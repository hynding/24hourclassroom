import { newSpecPage } from '@stencil/core/testing';

let config: any;
jest.mock('../../services/site-store', () => ({
  siteStore: { get config() { return config; } },
}));

import { AppBanner } from './app-banner';

const base = { theme: { layout: 'stacked', palette: 'noon', typeset: 'editorial' }, identity: { name: 'X', tagline: null }, registration: { open: true, message: null } };

describe('app-banner', () => {
  it('renders nothing when disabled or empty', async () => {
    config = { ...base, banner: { enabled: false, text: 'Hidden' } };
    const off = await newSpecPage({ components: [AppBanner], html: '<app-banner></app-banner>' });
    expect(off.root.shadowRoot.querySelector('aside')).toBeNull();

    config = { ...base, banner: { enabled: true, text: null } };
    const empty = await newSpecPage({ components: [AppBanner], html: '<app-banner></app-banner>' });
    expect(empty.root.shadowRoot.querySelector('aside')).toBeNull();
  });

  it('renders the announcement when enabled, and updates on site:changed', async () => {
    config = { ...base, banner: { enabled: true, text: 'Snow day' } };
    const page = await newSpecPage({ components: [AppBanner], html: '<app-banner></app-banner>' });
    const aside = page.root.shadowRoot.querySelector('aside')!;
    expect(aside.getAttribute('aria-label')).toBe('Site announcement');
    expect(aside.textContent).toContain('Snow day');

    config = { ...base, banner: { enabled: false, text: null } };
    page.win.dispatchEvent(new (page.win as any).CustomEvent('site:changed'));
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('aside')).toBeNull();
  });
});
