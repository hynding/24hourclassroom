import { newSpecPage } from '@stencil/core/testing';

const unreadCount = jest.fn();
let listener: (user: unknown) => void = () => {};
const currentUser = { value: null as unknown };

jest.mock('../../services/profile-store', () => ({
  profileStore: { unreadCount: (...a: unknown[]) => unreadCount(...a) },
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
    currentUser.value = null;
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
});
