import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const notifications = jest.fn();
const markRead = jest.fn();
const recoverFromExpiredSession = jest.fn();

jest.mock('../../services/profile-store', () => ({
  profileStore: {
    notifications: (...a: unknown[]) => notifications(...a),
    markRead: (...a: unknown[]) => markRead(...a),
  },
}));

jest.mock('../../services/session-recovery', () => ({
  recoverFromExpiredSession: (...a: unknown[]) => recoverFromExpiredSession(...a),
}));

import { PageNotifications } from './page-notifications';

const item = (id: string, name: string) => ({
  id, type: 'App\\Notifications\\NewFollower', read_at: null,
  created_at: '2026-09-10T00:00:00Z', data: { user: { id: 1, name, role: 'teacher', avatar_url: null } },
});

describe('page-notifications', () => {
  beforeEach(() => {
    notifications.mockReset().mockResolvedValue({ data: [], meta: { current_page: 1, last_page: 1, per_page: 15, total: 0 } });
    markRead.mockReset().mockResolvedValue(undefined);
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
  });

  const mount = () =>
    newSpecPage({ components: [PageNotifications], html: '<page-notifications></page-notifications>' });

  it('lists notifications', async () => {
    notifications.mockResolvedValue({
      data: [item('a', 'Ada'), item('b', 'Grace')],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 2 },
    });

    const spec = await mount();
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Ada');
    expect(spec.root.shadowRoot.textContent).toContain('Grace');
  });

  it('marks everything read on load so the badge clears', async () => {
    notifications.mockResolvedValue({
      data: [item('a', 'Ada')],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 1 },
    });

    const spec = await mount();
    await spec.waitForChanges();

    expect(markRead).toHaveBeenCalled();
  });

  it('shows an error and no empty-state copy when the load fails', async () => {
    notifications.mockRejectedValue(new ApiError(500, 'Server Error'));

    const spec = await mount();
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('We could not load your notifications.');
    expect(text).not.toContain('Nothing new.');
  });

  it('delegates a 401 to session recovery', async () => {
    notifications.mockRejectedValue(new ApiError(401, 'Unauthenticated.'));
    recoverFromExpiredSession.mockReturnValue(true);

    const spec = await mount();
    await spec.waitForChanges();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    expect(spec.root.shadowRoot.textContent).not.toContain('We could not load your notifications.');
  });

  it('shows the empty state only after a successful load', async () => {
    const spec = await mount();
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Nothing new.');
  });

  it('requests the next page of notifications', async () => {
    notifications.mockResolvedValue({
      data: [item('a', 'Ada')],
      meta: { current_page: 1, last_page: 3, per_page: 15, total: 40 },
    });
    const spec = await mount();
    await spec.waitForChanges();

    await spec.rootInstance.nextPage();

    expect(notifications).toHaveBeenLastCalledWith(2);
  });

  it('hides the pager when there is only one page', async () => {
    const spec = await mount();
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).not.toContain('Page 1 of');
  });

  // @stencil/core/testing wipes every listener registered on `window`
  // (mock-doc's resetEventListeners, run from resetPlatform() at the very
  // start of every newSpecPage() call) before the component under test ever
  // mounts, so a listener attached before `mount()` can never observe the
  // dispatch from that first componentWillLoad -- it is gone before the
  // component runs. These tests instead mount once, attach the listener
  // once mount has settled (nothing wipes it again until the *next*
  // newSpecPage() call), and trigger a second, real load via nextPage() --
  // exercising the exact same dispatch line in load() without racing the
  // test harness's own reset.
  it('announces a read after a successful load so a persistently-mounted header can refetch', async () => {
    notifications.mockResolvedValue({
      data: [item('a', 'Ada')],
      meta: { current_page: 1, last_page: 2, per_page: 15, total: 20 },
    });
    const spec = await mount();
    await spec.waitForChanges();

    const onRead = jest.fn();
    window.addEventListener('notifications:read', onRead);
    try {
      await spec.rootInstance.nextPage();

      expect(onRead).toHaveBeenCalledTimes(1);
    } finally {
      window.removeEventListener('notifications:read', onRead);
    }
  });

  it('does not announce a read when the load failed', async () => {
    notifications.mockResolvedValueOnce({
      data: [item('a', 'Ada')],
      meta: { current_page: 1, last_page: 2, per_page: 15, total: 20 },
    });
    const spec = await mount();
    await spec.waitForChanges();

    notifications.mockRejectedValueOnce(new ApiError(500, 'Server Error'));
    const onRead = jest.fn();
    window.addEventListener('notifications:read', onRead);
    try {
      await spec.rootInstance.nextPage();

      expect(onRead).not.toHaveBeenCalled();
    } finally {
      window.removeEventListener('notifications:read', onRead);
    }
  });

  it('describes test notifications with a link', async () => {
    notifications.mockResolvedValue({
      data: [
        { id: 'a', type: 'App\\Notifications\\TestAssigned', read_at: null, created_at: '', data: { user: { id: 1, name: 'Ms K' }, test_id: 4, test_title: 'Cells' } },
        { id: 'b', type: 'App\\Notifications\\AttemptSubmitted', read_at: null, created_at: '', data: { user: { id: 2, name: 'Sam' }, test_id: 4, test_title: 'Cells', ungraded_count: 2 } },
        { id: 'c', type: 'App\\Notifications\\TestModerated', read_at: null, created_at: '', data: { message: 'Unpublished.' } },
      ],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 3 },
    });
    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Ms K assigned you "Cells"');
    expect(text).toContain('Sam submitted "Cells" (2 to grade)');
    expect(text).toContain('Unpublished.');
    expect(page.root.shadowRoot.querySelector('a[href="/tests/4/results"]')).not.toBeNull();
  });

  it('describes material notifications with a link and a moderation message', async () => {
    notifications.mockResolvedValue({
      data: [
        { id: 'd', type: 'App\\Notifications\\MaterialShared', read_at: null, created_at: '', data: { user: { id: 1, name: 'Ms K' }, material_id: 9, material_title: 'Cell diagram' } },
        // Actor-less, like TestModerated: no `user` key at all, so the
        // deactivated-actor filter cannot hide it.
        { id: 'e', type: 'App\\Notifications\\MaterialModerated', read_at: null, created_at: '', data: { material_id: 9, material_title: 'Cell diagram', message: 'An administrator removed "Cell diagram" from the public library.' } },
      ],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 2 },
    });

    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Ms K shared "Cell diagram" with you');
    expect(text).toContain('An administrator removed "Cell diagram" from the public library.');
    expect(page.root.shadowRoot.querySelector('a[href="/materials/9"]')).not.toBeNull();
  });

  it('names an unknown sharer generically rather than rendering undefined', async () => {
    notifications.mockResolvedValue({
      data: [{ id: 'f', type: 'App\\Notifications\\MaterialShared', read_at: null, created_at: '', data: { material_id: 9, material_title: 'Cell diagram' } }],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 1 },
    });

    const page = await mount();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('A teacher shared "Cell diagram" with you');
    expect(page.root.shadowRoot.textContent).not.toContain('undefined');
  });
});
