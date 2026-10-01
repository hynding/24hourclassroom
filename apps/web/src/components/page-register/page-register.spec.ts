import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

let config: any = { registration: { open: true, message: null } };
const register = jest.fn();
jest.mock('../../services/site-store', () => ({ siteStore: { get config() { return config; } } }));
jest.mock('../../services/auth-store', () => ({ authStore: { register: (...a: unknown[]) => register(...a) } }));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));

import { PageRegister } from './page-register';

describe('page-register', () => {
  beforeEach(() => {
    config = { registration: { open: true, message: null } };
    register.mockReset();
  });

  it('renders name, email, password fields and both role options', async () => {
    const page = await newSpecPage({ components: [PageRegister], html: '<page-register></page-register>' });
    const root = page.root.shadowRoot;
    expect(root.querySelector('input[type="email"]')).not.toBeNull();
    expect(root.querySelectorAll('input[type="password"]').length).toBe(2);
    expect(root.textContent).toContain('Teacher');
    expect(root.textContent).toContain('Student');
  });

  it('shows the closed message instead of the form while registration is closed', async () => {
    config = { registration: { open: false, message: 'Closed for the summer.' } };
    const page = await newSpecPage({ components: [PageRegister], html: '<page-register></page-register>' });
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(page.root.shadowRoot.querySelector('.notice')!.textContent).toBe('Closed for the summer.');
  });

  it('renders a 403 from the API as the closed state, not an email field error', async () => {
    register.mockRejectedValue(new ApiError(403, 'Closed now.'));
    const page = await newSpecPage({ components: [PageRegister], html: '<page-register></page-register>' });
    (page.rootInstance as any).onSubmit(new Event('submit'));
    await page.waitForChanges();
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(page.root.shadowRoot.querySelector('.notice')!.textContent).toBe('Closed now.');
  });
});
