import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const connections = jest.fn();
const getMaterial = jest.fn();
const listMaterialShares = jest.fn();
const shareMaterial = jest.fn();
const unshareMaterial = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/profile-store', () => ({ profileStore: { connections: (...a: unknown[]) => connections(...a) } }));
jest.mock('../../services/materials-store', () => ({
  materialsStore: {
    getMaterial: (...a: unknown[]) => getMaterial(...a),
    listMaterialShares: (...a: unknown[]) => listMaterialShares(...a),
    shareMaterial: (...a: unknown[]) => shareMaterial(...a),
    unshareMaterial: (...a: unknown[]) => unshareMaterial(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageMaterialShare } from './page-material-share';

const view = (extra: Record<string, unknown> = {}) => ({
  id: 7, title: 'Cell diagram', description: null, subject: 'science', grade_level: '6-8',
  visibility: 'private', published_at: null, original_name: 'cells.pdf', mime_type: 'application/pdf',
  size_bytes: 1536, author: { id: 1, name: 'Me' }, created_at: '', updated_at: '',
  is_author: true, shared_with_me: false, download_url: 'https://api.test/x', ...extra,
});

const mount = async () => {
  const page = await newSpecPage({ components: [PageMaterialShare], html: '<page-material-share material-id="7"></page-material-share>' });
  await page.waitForChanges();
  return page;
};

describe('page-material-share', () => {
  beforeEach(() => {
    getMaterial.mockReset().mockResolvedValue(view());
    connections.mockReset().mockResolvedValue({ data: [
      { id: 1, user: { id: 20, name: 'Sam', role: 'student' } },
      { id: 2, user: { id: 21, name: 'Ms Other', role: 'teacher' } },
      { id: 3, user: { id: 22, name: 'Root', role: 'admin' } },
    ] });
    listMaterialShares.mockReset().mockResolvedValue({ data: [] });
    shareMaterial.mockReset();
    unshareMaterial.mockReset();
    navigate.mockReset();
  });

  it('lists teacher and student connections and no other role', async () => {
    // Allowlist: a handout is as useful teacher-to-teacher as
    // teacher-to-student, but a fourth role must be invalid by default.
    const page = await mount();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Sam');
    expect(text).toContain('Ms Other');
    expect(text).not.toContain('Root');
    expect(page.root.shadowRoot.querySelectorAll('input[type="checkbox"]')).toHaveLength(2);
    // The role badge distinguishes the two.
    expect(text).toContain('Teacher');
    expect(text).toContain('Student');
  });

  it('shares the checked users and reports each id', async () => {
    shareMaterial.mockResolvedValue({ results: [{ id: 20, status: 'shared' }, { id: 21, status: 'not_found' }] });
    listMaterialShares
      .mockResolvedValueOnce({ data: [] })
      .mockResolvedValueOnce({ data: [{ id: 5, user: { id: 20, name: 'Sam', role: 'student' }, created_at: '2026-09-19T00:00:00Z' }] });

    const page = await mount();
    const cmp = page.rootInstance as PageMaterialShare;
    cmp.selected = new Set([20, 21]);

    await cmp.share();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(shareMaterial).toHaveBeenCalledWith(7, [20, 21]);
    expect(text).toContain('Sam: shared');
    // Never says why -- every ineligible target collapses to not_found.
    expect(text).toContain('Ms Other: could not be shared');
    expect(cmp.selected.size).toBe(0);
    expect(listMaterialShares).toHaveBeenCalledTimes(2);
  });

  it('does nothing when nothing is checked', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageMaterialShare;

    await cmp.share();

    expect(shareMaterial).not.toHaveBeenCalled();
  });

  it('lists current recipients and revokes one by share id', async () => {
    listMaterialShares.mockResolvedValue({ data: [{ id: 5, user: { id: 20, name: 'Sam', role: 'student' }, created_at: '2026-09-19T00:00:00Z' }] });
    unshareMaterial.mockResolvedValue(undefined);

    const page = await mount();
    expect(page.root.shadowRoot.textContent).toContain('Sam');
    const cmp = page.rootInstance as PageMaterialShare;

    await cmp.remove(5);

    // The SHARE id, not the user id: they are different id spaces.
    expect(unshareMaterial).toHaveBeenCalledWith(7, 5);
    expect(listMaterialShares).toHaveBeenCalledTimes(2);
  });

  it('labels a recipient promoted to admin as Other, not Student', async () => {
    // The API does not role-filter the recipient list (unlike the connection
    // checklist above it), so a share whose user is now an admin must not
    // fall through a role !== 'teacher' default to 'Student'. Connections
    // are emptied here so the checklist contributes no 'Student'/'Teacher'
    // text of its own, isolating the assertion to the recipient badge.
    connections.mockResolvedValue({ data: [] });
    listMaterialShares.mockResolvedValue({ data: [{ id: 5, user: { id: 22, name: 'Root', role: 'admin' }, created_at: '2026-09-19T00:00:00Z' }] });

    const page = await mount();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Other');
    expect(text).not.toContain('Student');
  });

  it('says so when there is nobody to share with yet', async () => {
    connections.mockResolvedValue({ data: [] });

    const page = await mount();

    expect(page.root.shadowRoot.textContent).toContain('You have no accepted connections to share with yet.');
  });

  it('bounces a non-author to the material page and renders no checklist', async () => {
    getMaterial.mockResolvedValue(view({ is_author: false }));

    const page = await mount();

    expect(navigate).toHaveBeenCalledWith('/materials/7');
    expect(page.root.shadowRoot.querySelector('input[type="checkbox"]')).toBeNull();
    expect(connections).not.toHaveBeenCalled();
  });

  it('renders not found on a 404', async () => {
    getMaterial.mockRejectedValue(new ApiError(404, 'nope'));

    const page = await mount();

    expect(page.root.shadowRoot.textContent).toContain('Material not found');
  });
});
