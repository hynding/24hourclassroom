import { newSpecPage } from '@stencil/core/testing';
import type { Role } from '@24hc/shared';

let config: any = { identity: { name: 'Night School', tagline: null }, registration: { open: true, message: null } };
jest.mock('../../services/site-store', () => ({ siteStore: { get config() { return config; } } }));

let currentUser: any = null;
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, subscribe: () => () => undefined },
}));

const navigate = jest.fn();
jest.mock('../../services/navigate', () => ({ navigate: (path: string) => navigate(path) }));

import { PageHome } from './page-home';

const hrefs = (page: any) => Array.from(page.root.shadowRoot.querySelectorAll('.cards a')).map((a: any) => a.getAttribute('href'));

describe('page-home', () => {
  beforeEach(() => {
    config = { identity: { name: 'Night School', tagline: null }, registration: { open: true, message: null } };
    currentUser = null;
    navigate.mockReset();
  });

  it('renders the site name as the headline, with the tagline only when set', async () => {
    const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
    expect(page.root.shadowRoot.querySelector('h1')!.textContent).toBe('Night School');
    expect(page.root.shadowRoot.querySelector('p.tagline')).toBeNull();

    config = { ...config, identity: { name: 'Night School', tagline: 'Lessons after dark' } };
    page.win.dispatchEvent(new (page.win as any).CustomEvent('site:changed'));
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('p.tagline')!.textContent).toBe('Lessons after dark');
  });

  it('points a visitor at the library, the directory and the way in', async () => {
    const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
    expect(hrefs(page)).toEqual(['/library', '/teachers', '/register', '/login']);
    expect(page.root.shadowRoot.querySelector('a[href="/register"]').classList.contains('primary')).toBe(true);

    (page.root.shadowRoot.querySelector('a[href="/library"]') as HTMLAnchorElement).click();
    expect(navigate).toHaveBeenCalledWith('/library');
  });

  it('offers sign-in instead of sign-up while registration is closed', async () => {
    config = { ...config, registration: { open: false, message: 'Closed for the summer.' } };
    const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
    expect(hrefs(page)).toEqual(['/library', '/teachers', '/login']);
    expect(page.root.shadowRoot.querySelector('a[href="/register"]')).toBeNull();
  });

  it('gives a signed-in user shortcuts to exactly the shelves the menu allows', async () => {
    const expected: Record<Role, string[]> = {
      teacher: ['/tests', '/materials', '/courses', '/library', '/teachers'],
      student: ['/tests', '/materials', '/library', '/teachers'],
      admin: ['/library', '/teachers'],
    };
    for (const role of Object.keys(expected) as Role[]) {
      currentUser = { id: 1, name: 'Ada', email_verified_at: '2026-01-01', role };
      const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
      expect(hrefs(page)).toEqual(expected[role]);
      expect(page.root.shadowRoot.querySelector('a[href="/register"]')).toBeNull();
    }
  });
});
