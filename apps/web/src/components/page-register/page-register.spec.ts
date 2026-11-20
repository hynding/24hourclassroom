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
    sessionStorage.clear();
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

  it('asks a student, and only a student or assistant, for a birth month and year, and sends it', async () => {
    register.mockResolvedValue(undefined);
    const page = await newSpecPage({ components: [PageRegister], html: '<page-register></page-register>' });
    const cmp = page.rootInstance as any;
    expect(page.root.shadowRoot.querySelector('select[aria-label="Birth year"]')).toBeNull();

    cmp.role = 'student';
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('select[aria-label="Birth year"]')).not.toBeNull();
    expect(page.root.shadowRoot.textContent).not.toContain('13 or older');

    cmp.birth = { month: 4, year: 2005 };
    await cmp.onSubmit(new Event('submit'));
    expect(register).toHaveBeenCalledWith(expect.objectContaining({ role: 'student', birth_month: 4, birth_year: 2005 }));
  });

  it('replaces the form with the notice after an under-13 refusal, for the rest of the tab session', async () => {
    register.mockRejectedValue(new ApiError(422, 'Invalid', { birth_year: ['You need to be 13 or older to make your own account.'] }));
    const page = await newSpecPage({ components: [PageRegister], html: '<page-register></page-register>' });
    const cmp = page.rootInstance as any;
    cmp.role = 'student';
    cmp.birth = { month: 1, year: 2018 };
    await cmp.onSubmit(new Event('submit'));
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(page.root.shadowRoot.querySelector('.notice')!.textContent).toContain('13 or older');

    // The tab remembers the refusal, so a reload shows the notice again.
    expect(page.win.sessionStorage.getItem('24hc.age-screen.v1')).toBe('blocked');
  });
});
