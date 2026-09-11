import { forceUpdate } from '@stencil/core';
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

  // B8. GoogleOAuthController now redirects a DEACTIVATED account to
  // {spaOrigin}/login?error=deactivated (wave A, commit 10f2ca5). The page
  // only recognised ?error=oauth, so a deactivated user who clicked
  // "Continue with Google" landed on a plain login form with no
  // explanation at all -- the exact failure the 401-not-403 decision was
  // supposed to make legible.
  const mountWith = async (search: string) => {
    // newSpecPage() builds a fresh mock window, so the query has to be set
    // AFTER mounting. The banner getters read it during render and nothing
    // else changes, so the re-render has to be forced explicitly --
    // waitForChanges() alone would flush nothing and every assertion below
    // would be made against the first, query-less render.
    const page = await newSpecPage({ components: [PageLogin], html: '<page-login></page-login>' });
    page.win.location.search = search;
    forceUpdate(page.rootInstance);
    await page.waitForChanges();
    return page;
  };

  it('explains a deactivated account rather than showing a bare form', async () => {
    const page = await mountWith('?error=deactivated');
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('deactivated');
    // Not the generic OAuth copy -- "try again" is wrong advice here,
    // because trying again will fail identically forever.
    expect(text).not.toContain("Google sign-in didn't complete");
  });

  it('still shows the generic OAuth failure for ?error=oauth', async () => {
    const page = await mountWith('?error=oauth');
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain("Google sign-in didn't complete");
    expect(text).not.toContain('deactivated');
  });

  it('shows neither banner on a plain visit', async () => {
    const page = await mountWith('');
    const text = page.root.shadowRoot.textContent;

    expect(text).not.toContain('deactivated');
    expect(text).not.toContain("Google sign-in didn't complete");
  });
});
