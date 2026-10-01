import { newSpecPage } from '@stencil/core/testing';

let config: any = { identity: { name: 'Night School', tagline: null } };
jest.mock('../../services/site-store', () => ({ siteStore: { get config() { return config; } } }));

import { AppFooter } from './app-footer';

it('names the site in the copyright line and follows site:changed', async () => {
  const page = await newSpecPage({ components: [AppFooter], html: '<app-footer></app-footer>' });
  expect(page.root.shadowRoot.textContent).toContain('© Night School');

  config = { identity: { name: 'Day School', tagline: null } };
  page.win.dispatchEvent(new (page.win as any).CustomEvent('site:changed'));
  await page.waitForChanges();
  expect(page.root.shadowRoot.textContent).toContain('© Day School');
});
