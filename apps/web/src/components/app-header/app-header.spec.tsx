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

// Deliberately NOT mocked: app-header does a real `instanceof` against it,
// and it lives outside profile-store precisely so the mock above cannot
// replace the constructor with an impostor.
import { StaleIdentityError } from '../../services/stale-identity';

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

  it('leaves the badge alone when a previous identity\'s count resolves late', async () => {
    // B2: an unreadCount() issued for user A, landing after user B has
    // signed in. The store now rejects it rather than handing A's number
    // back -- but the store half is only half the fix, because the header
    // is what assigns. Treating the rejection as a generic failure would
    // blank B's badge with the `this.unread = 0` fallback; the header must
    // write nothing at all and let B's own fetch stand.
    currentUser.value = verified;
    unreadCount.mockResolvedValueOnce(7);
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();
    expect(spec.root.shadowRoot.textContent).toContain('7');

    unreadCount.mockRejectedValueOnce(new StaleIdentityError());
    window.dispatchEvent(new CustomEvent('notifications:read'));
    await Promise.resolve();
    await Promise.resolve();
    await spec.waitForChanges();

    expect(unreadCount).toHaveBeenCalledTimes(2);
    expect(spec.root.shadowRoot.textContent).toContain('7');
    // A stale response is not a session expiry and must not be reported as
    // one -- routing it through recovery would bounce the user to /login.
    expect(recoverFromExpiredSession).not.toHaveBeenCalled();
  });

  it('still blanks the badge when the fetch fails for an ordinary reason', async () => {
    // The exclusion side: the leave-it-alone branch is scoped to
    // StaleIdentityError, not applied to every rejection.
    currentUser.value = verified;
    unreadCount.mockResolvedValueOnce(7);
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    await spec.waitForChanges();
    expect(spec.root.shadowRoot.textContent).toContain('7');

    unreadCount.mockRejectedValueOnce(new ApiError(500, 'Server Error'));
    window.dispatchEvent(new CustomEvent('notifications:read'));
    await Promise.resolve();
    await Promise.resolve();
    await spec.waitForChanges();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    expect(spec.root.shadowRoot.querySelector('[data-testid="unread-badge"]')).toBeNull();
  });

  it('reflects the default orientation so app-header.css can key on it', async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    expect(spec.root.getAttribute('orientation')).toBe('horizontal');
  });

  it('reflects a vertical orientation', async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header orientation="vertical"></app-header>' });
    expect(spec.root.getAttribute('orientation')).toBe('vertical');
    expect(spec.root.getAttribute('orientation')).not.toBe('horizontal');
  });

  it('marks the brand link as the wordmark', async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    expect(spec.root.shadowRoot.querySelector('a.wordmark')?.textContent).toContain('24 Hour Classroom');
  });

  it('shows Tests for teachers and students only, and Library for everyone', async () => {
    for (const [role, expected] of [['teacher', true], ['student', true], ['admin', false]] as const) {
      currentUser.value = { id: 1, name: 'U', email_verified_at: '2026-01-01', role };
      const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
      const links = Array.from(spec.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
      expect(links.includes('/tests')).toBe(expected);
      expect(links).toContain('/library');
    }
    currentUser.value = null;
    const guest = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    const links = Array.from(guest.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
    expect(links).toContain('/library');
    expect(links).not.toContain('/tests');
  });
});
