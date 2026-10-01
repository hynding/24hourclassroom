import { newSpecPage } from '@stencil/core/testing';

let config: any = { identity: { name: 'Night School', tagline: null } };
jest.mock('../../services/site-store', () => ({ siteStore: { get config() { return config; } } }));

import { PageHome } from './page-home';

describe('page-home', () => {
  it('renders the site name as the headline, with the tagline only when set', async () => {
    const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
    expect(page.root.shadowRoot.querySelector('h1')!.textContent).toBe('Night School');
    expect(page.root.shadowRoot.querySelector('p')).toBeNull();

    config = { identity: { name: 'Night School', tagline: 'Lessons after dark' } };
    page.win.dispatchEvent(new (page.win as any).CustomEvent('site:changed'));
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('p')!.textContent).toBe('Lessons after dark');
  });
});
