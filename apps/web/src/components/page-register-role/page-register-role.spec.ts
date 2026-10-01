import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

let config: any = { registration: { open: true, message: null } };
const completeOauth = jest.fn();
jest.mock('../../services/site-store', () => ({ siteStore: { get config() { return config; } } }));
jest.mock('../../services/auth-store', () => ({ authStore: { completeOauth: (...a: unknown[]) => completeOauth(...a) } }));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));

import { PageRegisterRole } from './page-register-role';

describe('page-register-role', () => {
  beforeEach(() => {
    config = { registration: { open: true, message: null } };
    completeOauth.mockReset();
  });

  it('renders the role form while open', async () => {
    const page = await newSpecPage({ components: [PageRegisterRole], html: '<page-register-role></page-register-role>' });
    expect(page.root.shadowRoot.querySelector('form')).not.toBeNull();
  });

  it('shows the closed message instead of the form while registration is closed', async () => {
    config = { registration: { open: false, message: 'Closed for the summer.' } };
    const page = await newSpecPage({ components: [PageRegisterRole], html: '<page-register-role></page-register-role>' });
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(page.root.shadowRoot.querySelector('.notice')!.textContent).toBe('Closed for the summer.');
  });

  it('renders a 403 from the API as the closed state', async () => {
    completeOauth.mockRejectedValue(new ApiError(403, 'Closed now.'));
    const page = await newSpecPage({ components: [PageRegisterRole], html: '<page-register-role></page-register-role>' });
    (page.rootInstance as any).onSubmit(new Event('submit'));
    await page.waitForChanges();
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(page.root.shadowRoot.querySelector('.notice')!.textContent).toBe('Closed now.');
  });
});
