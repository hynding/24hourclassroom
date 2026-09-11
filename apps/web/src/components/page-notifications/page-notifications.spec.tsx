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
});
