import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const unreadCount = jest.fn();
const recoverFromExpiredSession = jest.fn();
let listener: (user: unknown) => void = () => {};
const currentUser = { value: null as unknown };

jest.mock('../../services/profile-store', () => ({
  profileStore: { unreadCount: (...a: unknown[]) => unreadCount(...a) },
}));

jest.mock('../../services/session-recovery', () => ({
  recoverFromExpiredSession: (...a: unknown[]) => recoverFromExpiredSession(...a),
}));

jest.mock('../../services/auth-store', () => ({
  authStore: {
    get currentUser() { return currentUser.value; },
    subscribe: (fn: (user: unknown) => void) => { listener = fn; return () => {}; },
    logout: jest.fn(),
  },
}));

import { AppHeader } from './app-header';

const verified = { id: 1, name: 'Ada', email_verified_at: '2026-01-01', role: 'teacher' };
const unverified = { id: 2, name: 'Sam', email_verified_at: null, role: 'teacher' };

describe('app-header bell', () => {
  beforeEach(() => {
    unreadCount.mockReset().mockResolvedValue(3);
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
    currentUser.value = null;
    listener = () => {};
  });

  it('shows the unread badge for a signed-in verified user', async () => {
    currentUser.value = verified;
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('3');
    expect(unreadCount).toHaveBeenCalled();
  });

  it('shows no bell for a signed-out visitor', async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();

    expect(unreadCount).not.toHaveBeenCalled();
    expect(spec.root.shadowRoot.querySelector('[data-testid="unread-badge"]')).toBeNull();
  });

  it('shows no bell for an unverified user', async () => {
    // Every notification-producing action is behind `verified`, so an
    // unverified user can never have one -- fetching would be a guaranteed
    // wasted request.
    currentUser.value = unverified;
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();

    expect(unreadCount).not.toHaveBeenCalled();
  });

  it('hides the badge when the count is zero', async () => {
    currentUser.value = verified;
    unreadCount.mockResolvedValue(0);
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.querySelector('[data-testid="unread-badge"]')).toBeNull();
  });

  it('refetches and updates the badge when notifications:read fires', async () => {
    // app-header is mounted once, persistently, outside the route switch, so
    // navigating to /notifications never re-fires the auth subscription --
    // the header must react to the event page-notifications dispatches
    // instead, or its local `unread` copy goes stale.
    currentUser.value = verified;
    unreadCount.mockResolvedValueOnce(3).mockResolvedValueOnce(7);
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('3');

    window.dispatchEvent(new CustomEvent('notifications:read'));
    // The @Listen handler kicks off an async fetch that isn't awaited by
    // dispatchEvent itself; give its promise chain a turn before flushing
    // the render Stencil schedules once state actually changes.
    await Promise.resolve();
    await spec.waitForChanges();

    expect(unreadCount).toHaveBeenCalledTimes(2);
    expect(spec.root.shadowRoot.textContent).toContain('7');
    expect(spec.root.shadowRoot.textContent).not.toContain('3');
  });

  it('delegates a 401 from unreadCount to session recovery without throwing', async () => {
    currentUser.value = verified;
    unreadCount.mockRejectedValue(new ApiError(401, 'Unauthenticated.'));
    recoverFromExpiredSession.mockReturnValue(true);

    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    expect(spec.root.shadowRoot.querySelector('[data-testid="unread-badge"]')).toBeNull();
  });
});
