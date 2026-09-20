import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const listMaterials = jest.fn();
const sharedMaterials = jest.fn();
let currentUser: unknown = null;
jest.mock('../../services/materials-store', () => ({
  materialsStore: {
    listMaterials: (...a: unknown[]) => listMaterials(...a),
    sharedMaterials: (...a: unknown[]) => sharedMaterials(...a),
  },
}));
// load() is what app-root leaves in flight while the route renders; `pending`
// models it so a page that reads the role without awaiting sees no user.
let pending: unknown = null;
const authLoad = jest.fn(async () => { currentUser = pending; return currentUser; });
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: () => authLoad() },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageMaterials } from './page-materials';

const mine = (id: number, title: string, extra: Record<string, unknown> = {}) => ({
  id, title, subject: 'science', grade_level: '6-8', visibility: 'private', published_at: null,
  original_name: 'cells.pdf', mime_type: 'application/pdf', size_bytes: 1536, author: { id: 1, name: 'Me' }, ...extra,
});
const shared = (id: number, title: string) => ({
  ...mine(id, title), author: { id: 2, name: 'Ms K' }, shared_at: '2026-09-10T00:00:00Z',
});
const paginated = (data: unknown[], lastPage = 1) => ({ data, meta: { current_page: 1, last_page: lastPage, per_page: 15, total: data.length } });

const mount = () => newSpecPage({ components: [PageMaterials], html: '<page-materials></page-materials>' });

describe('page-materials', () => {
  beforeEach(() => {
    listMaterials.mockReset().mockResolvedValue(paginated([]));
    sharedMaterials.mockReset().mockResolvedValue(paginated([]));
    authLoad.mockClear();
    currentUser = null;
    pending = null;
  });

  it('shows a teacher their own materials, an upload link, and the shared section', async () => {
    pending = { id: 1, role: 'teacher' };
    listMaterials.mockResolvedValue(paginated([mine(3, 'Cell diagram')]));
    sharedMaterials.mockResolvedValue(paginated([shared(8, 'Rock cycle')]));

    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Cell diagram');
    expect(text).toContain('Rock cycle');
    expect(text).toContain('Shared with me');
    expect(text).toContain('PDF');
    expect(text).toContain('1.5 KB');
    expect(text).toContain('Private');
    expect(page.root.shadowRoot.querySelector('a[href="/materials/new"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/materials/3"]')).not.toBeNull();
    // The role has to come from the awaited load, not from whatever the store
    // happened to hold when app-root rendered the route.
    expect(authLoad).toHaveBeenCalled();
  });

  it('shows a student only the shared section and never asks for an own list', async () => {
    pending = { id: 2, role: 'student' };
    sharedMaterials.mockResolvedValue(paginated([shared(8, 'Rock cycle')]));

    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Rock cycle');
    expect(text).toContain('Shared with me');
    expect(listMaterials).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.querySelector('a[href="/materials/new"]')).toBeNull();
  });

  it('renders an empty state for any other role and fetches nothing', async () => {
    // Allowlist: admin (and any fourth role) gets the empty state, per the
    // spec -- admin moderation is Inertia-only.
    pending = { id: 4, role: 'admin' };

    const page = await mount();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('no materials for this account');
    expect(listMaterials).not.toHaveBeenCalled();
    expect(sharedMaterials).not.toHaveBeenCalled();
  });

  it('shows the signed-out empty state only when the load really finds nobody', async () => {
    pending = null;

    const page = await mount();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('no materials for this account');
    expect(sharedMaterials).not.toHaveBeenCalled();
  });

  it('tells a teacher with nothing uploaded what to do', async () => {
    pending = { id: 1, role: 'teacher' };

    const page = await mount();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('You have not uploaded any materials yet.');
    expect(page.root.shadowRoot.textContent).toContain('Nothing has been shared with you yet.');
  });

  it('pages the two sections independently', async () => {
    pending = { id: 1, role: 'teacher' };
    listMaterials.mockResolvedValue(paginated([mine(3, 'Cell diagram')], 2));
    sharedMaterials.mockResolvedValue(paginated([shared(8, 'Rock cycle')], 2));

    const page = await mount();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterials;

    await cmp.goOwn(1);
    expect(listMaterials).toHaveBeenLastCalledWith(2);
    // The shared pager must not have moved with it.
    expect(sharedMaterials).toHaveBeenLastCalledWith(undefined);

    await cmp.goShared(1);
    expect(sharedMaterials).toHaveBeenLastCalledWith(2);
    expect(cmp.page).toBe(2);
  });

  it('refuses to page past the last page', async () => {
    pending = { id: 1, role: 'teacher' };

    const page = await mount();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterials;
    listMaterials.mockClear();

    await cmp.goOwn(1);
    await cmp.goOwn(-1);

    expect(listMaterials).not.toHaveBeenCalled();
    expect(cmp.page).toBe(1);
  });

  it('shows an error instead of an empty state when the load fails', async () => {
    pending = { id: 1, role: 'teacher' };
    listMaterials.mockRejectedValue(new ApiError(500, 'Server Error'));

    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('We could not load your materials.');
    expect(text).not.toContain('You have not uploaded any materials yet.');
  });
});
