import { newSpecPage } from '@stencil/core/testing';
import { PageLogin } from './page-login';

describe('page-login', () => {
  it('renders email/password fields and a Google link', async () => {
    const page = await newSpecPage({ components: [PageLogin], html: '<page-login></page-login>' });
    const root = page.root.shadowRoot;
    expect(root.querySelector('input[type="email"]')).not.toBeNull();
    expect(root.querySelector('input[type="password"]')).not.toBeNull();
    expect(root.textContent).toContain('Google');
  });

  it('renders field errors from state', async () => {
    const page = await newSpecPage({ components: [PageLogin], html: '<page-login></page-login>' });
    (page.rootInstance as PageLogin).errors = { email: ['These credentials do not match.'] };
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('These credentials do not match.');
  });
});
