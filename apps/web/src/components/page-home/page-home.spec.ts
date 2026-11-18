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

const myAssignments = jest.fn();
jest.mock('../../services/tests-store', () => ({ testsStore: { myAssignments: () => myAssignments() } }));

import { PageHome } from './page-home';

const hrefs = (page: any) => Array.from(page.root.shadowRoot.querySelectorAll('.cards a')).map((a: any) => a.getAttribute('href'));

describe('page-home', () => {
  beforeEach(() => {
    config = { identity: { name: 'Night School', tagline: null }, registration: { open: true, message: null } };
    currentUser = null;
    navigate.mockReset();
    myAssignments.mockReset().mockResolvedValue({ data: [] });
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
      tutor: ['/connections', '/tests', '/materials', '/courses', '/library', '/teachers'],
      assistant: ['/connections', '/materials', '/library', '/teachers'],
      guardian: ['/connections', '/library', '/teachers'],
    };
    for (const role of Object.keys(expected) as Role[]) {
      currentUser = { id: 1, name: 'Ada', email_verified_at: '2026-01-01', role };
      const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
      expect(hrefs(page)).toEqual(expected[role]);
      expect(page.root.shadowRoot.querySelector('a[href="/register"]')).toBeNull();
    }
  });

  describe('a student\'s Up next', () => {
    const day = (offset: number) => {
      const d = new Date();
      d.setDate(d.getDate() + offset);
      const pad = (n: number) => String(n).padStart(2, '0');
      return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T00:00:00.000000Z`;
    };
    const summary = (submitted_at: string | null, score: string | null = '8.00') => ({
      id: 70, test_id: 1, assignment_id: 1, started_at: day(-1), submitted_at, score, max_score: '10.00', graded_at: null, ungraded_count: 0,
    });
    const assignment = (id: number, due_at: string | null, latest: unknown = null) => ({
      id, due_at, latest, best: null,
      test: { id, title: `Quiz ${id}`, subject: 'science', grade_level: '9-12', question_count: 10, author: { id: 2, name: 'Ms K' } },
    });
    const mount = async () => {
      currentUser = { id: 1, name: 'Ada', email_verified_at: '2026-01-01', role: 'student' };
      const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
      await page.waitForChanges();
      return page;
    };

    it('lists overdue work, this week\'s work, what comes later and recent scores', async () => {
      myAssignments.mockResolvedValue({ data: [
        assignment(1, day(-3), summary(null)),
        assignment(2, day(2)),
        assignment(3, day(30)),
        assignment(4, null),
        assignment(5, day(-5), summary(new Date().toISOString())),
      ] });
      const root = (await mount()).root.shadowRoot;
      const box = root.querySelector('.up-next');

      expect(box.querySelector('h2').textContent).toBe('Up next');
      expect(Array.from(box.querySelectorAll('h3')).map((h) => h.textContent)).toEqual(['Overdue', 'Due this week', 'Recent scores']);
      expect(box.querySelector('.overdue a').getAttribute('href')).toBe('/tests/1');
      expect(box.querySelector('.overdue').textContent).toContain('started');
      expect(box.querySelector('.this-week a').getAttribute('href')).toBe('/tests/2');
      expect(box.textContent).toContain('2 more due later');
      expect(box.querySelector('.recent a').getAttribute('href')).toBe('/attempts/70');
      expect(box.querySelector('.recent').textContent).toContain('8.00 / 10.00');
      // The shelves are still there below it.
      expect(Array.from(root.querySelectorAll('.cards a')).map((a) => a.getAttribute('href'))).toContain('/tests');
    });

    it('says when nothing is due, and points at what is open or the library', async () => {
      myAssignments.mockResolvedValue({ data: [assignment(3, day(30))] });
      let box = (await mount()).root.shadowRoot.querySelector('.up-next');
      expect(box.textContent).toContain('Nothing is due this week.');
      expect(box.querySelector('a').textContent).toBe('See all 1 open assignment');

      myAssignments.mockResolvedValue({ data: [] });
      box = (await mount()).root.shadowRoot.querySelector('.up-next');
      expect(box.querySelector('a').getAttribute('href')).toBe('/library');
    });

    it('caps each list and links the rest', async () => {
      myAssignments.mockResolvedValue({ data: [1, 2, 3, 4, 5, 6, 7].map((id) => assignment(id, day(-id))) });
      const box = (await mount()).root.shadowRoot.querySelector('.up-next');
      expect(box.querySelectorAll('.overdue li')).toHaveLength(5);
      expect(box.textContent).toContain('and 2 more on My tests');
    });

    it('says so when the assignments cannot be loaded', async () => {
      myAssignments.mockRejectedValue(new Error('offline'));
      const box = (await mount()).root.shadowRoot.querySelector('.up-next');
      expect(box.textContent).toContain('We could not load your assignments.');
    });

    it('is only for students: nobody else asks for assignments', async () => {
      for (const role of ['teacher', 'tutor', 'assistant', 'guardian', 'admin'] as Role[]) {
        currentUser = { id: 1, name: 'Ada', email_verified_at: '2026-01-01', role };
        const page = await newSpecPage({ components: [PageHome], html: '<page-home></page-home>' });
        expect(page.root.shadowRoot.querySelector('.up-next')).toBeNull();
      }
      expect(myAssignments).not.toHaveBeenCalled();
    });
  });
});

