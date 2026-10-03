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

const navigate = jest.fn();
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));

let siteConfig: any = { identity: { name: 'Night School', tagline: null } };
jest.mock('../../services/site-store', () => ({ siteStore: { get config() { return siteConfig; } } }));

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
    siteConfig = { identity: { name: 'Night School', tagline: null } };
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
    expect(spec.root.shadowRoot.querySelector('a.wordmark')?.textContent).toContain('Night School');
  });

  it('re-renders the wordmark on site:changed', async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    siteConfig = { identity: { name: 'Day School', tagline: null } };
    spec.win.dispatchEvent(new (spec.win as any).CustomEvent('site:changed'));
    await spec.waitForChanges();
    expect(spec.root.shadowRoot.querySelector('a.wordmark')?.textContent).toContain('Day School');
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

  it('shows Materials for teachers and students only', async () => {
    // Allowlist, not a denylist: a fourth role must be invalid by default,
    // and an admin has no materials shelf (admin moderation is Inertia-only).
    for (const [role, expected] of [['teacher', true], ['student', true], ['admin', false]] as const) {
      currentUser.value = { id: 1, name: 'U', email_verified_at: '2026-01-01', role };
      const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
      const links = Array.from(spec.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
      expect(links.includes('/materials')).toBe(expected);
    }

    currentUser.value = null;
    const guest = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    const links = Array.from(guest.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
    expect(links).not.toContain('/materials');
  });

  it('shows Connections to teachers and students only, the two roles that can connect', async () => {
    // Allowlist, not a denylist: the server accepts connections between
    // Role::Teacher and Role::Student alone, so an admin (and any fourth
    // role) must not be offered the page.
    for (const [role, expected] of [['teacher', true], ['student', true], ['admin', false]] as const) {
      currentUser.value = { id: 1, name: 'U', email_verified_at: '2026-01-01', role };
      const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
      const links = Array.from(spec.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
      expect(links.includes('/connections')).toBe(expected);
    }

    currentUser.value = null;
    const guest = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    const links = Array.from(guest.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
    expect(links).not.toContain('/connections');
  });

  it('shows Integrations for teachers only', async () => {
    // Allowlist, not a denylist: the MCP server and every generation
    // endpoint admit Role::Teacher and nothing else, so a student, an admin
    // and any fourth role must not be offered the page at all.
    currentUser.value = { id: 1, name: 'U', email_verified_at: '2026-01-01', role: 'teacher' };
    const teacher = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    const teacherLinks = Array.from(teacher.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
    expect(teacherLinks).toContain('/integrations');

    for (const role of ['student', 'admin'] as const) {
      currentUser.value = { id: 1, name: 'U', email_verified_at: '2026-01-01', role };
      const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
      const links = Array.from(spec.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
      expect(links).not.toContain('/integrations');
    }

    currentUser.value = null;
    const guest = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    const guestLinks = Array.from(guest.root.shadowRoot.querySelectorAll('nav a')).map((a) => a.getAttribute('href'));
    expect(guestLinks).not.toContain('/integrations');
  });
});

describe('app-header side panel (vertical orientation)', () => {
  const panel = async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header orientation="vertical"></app-header>' });
    return spec;
  };

  beforeEach(() => {
    unreadCount.mockReset().mockResolvedValue(2);
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
    currentUser.value = { id: 1, name: 'Ada', email_verified_at: '2026-01-01', role: 'teacher' };
    siteConfig = { identity: { name: 'Night School', tagline: null } };
  });

  afterEach(() => {
    try { window.localStorage.removeItem('24hc.nav.collapsed.v1'); } catch { /* not available */ }
  });

  it('gives every menu link an icon and a tooltip naming it', async () => {
    const spec = await panel();
    const links = Array.from(spec.root.shadowRoot.querySelectorAll('nav a'));
    expect(links.length).toBeGreaterThan(5);
    for (const link of links) {
      expect(link.querySelector('svg')).not.toBeNull();
      expect(link.getAttribute('title')).toBe(link.querySelector('.label').textContent);
    }
    expect(links.map((a) => a.getAttribute('href'))).toContain('/connections');
    // Account controls sit at the bottom of the panel, outside the menu.
    const account = spec.root.shadowRoot.querySelector('.account');
    expect(account.textContent).toContain('Ada');
    expect(account.textContent).toContain('Log out');
  });

  it('collapses to icons with a labelled toggle, and remembers the choice', async () => {
    const spec = await panel();
    const toggle = spec.root.shadowRoot.querySelector('button.collapse') as HTMLButtonElement;
    expect(toggle.querySelector('svg')).not.toBeNull();
    expect(toggle.getAttribute('aria-expanded')).toBe('true');
    expect(toggle.getAttribute('aria-label')).toBe('Collapse menu');
    expect(spec.root.hasAttribute('collapsed')).toBe(false);

    toggle.click();
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('collapsed')).toBe(true);
    expect(toggle.getAttribute('aria-expanded')).toBe('false');
    expect(toggle.getAttribute('aria-label')).toBe('Expand menu');
    // Labels stay in the DOM for screen readers; CSS hides them visually.
    expect(spec.root.shadowRoot.querySelector('nav a .label')).not.toBeNull();
    expect(window.localStorage.getItem('24hc.nav.collapsed.v1')).toBe('1');

    // A fresh page has a fresh simulated window, so seed its storage the way
    // the first page left the real one, then render into it.
    const again = await newSpecPage({ components: [AppHeader], html: '' });
    again.win.localStorage.setItem('24hc.nav.collapsed.v1', '1');
    await again.setContent('<app-header orientation="vertical"></app-header>');
    expect(again.root.hasAttribute('collapsed')).toBe(true);

    (again.root.shadowRoot.querySelector('button.collapse') as HTMLButtonElement).click();
    await again.waitForChanges();
    expect(again.root.hasAttribute('collapsed')).toBe(false);
    expect(again.win.localStorage.getItem('24hc.nav.collapsed.v1')).toBe('0');
  });

  it('opens as a drawer on small screens and closes on Escape, a page pick or the backdrop', async () => {
    const spec = await panel();
    const menu = spec.root.shadowRoot.querySelector('button.menu') as HTMLButtonElement;
    expect(menu.getAttribute('aria-label')).toBe('Open menu');
    expect(menu.getAttribute('aria-expanded')).toBe('false');

    menu.click();
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('open')).toBe(true);
    expect(menu.getAttribute('aria-label')).toBe('Close menu');

    spec.win.dispatchEvent(new (spec.win as any).KeyboardEvent('keydown', { key: 'Escape' }));
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('open')).toBe(false);

    menu.click();
    await spec.waitForChanges();
    (spec.root.shadowRoot.querySelector('a[href="/library"]') as HTMLAnchorElement).click();
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('open')).toBe(false);
    expect(navigate).toHaveBeenCalledWith('/library');

    menu.click();
    await spec.waitForChanges();
    (spec.root.shadowRoot.querySelector('.backdrop') as HTMLElement).click();
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('open')).toBe(false);
  });

  it('keeps the top header free of panel controls', async () => {
    const spec = await newSpecPage({ components: [AppHeader], html: '<app-header></app-header>' });
    expect(spec.root.shadowRoot.querySelector('button.collapse')).toBeNull();
    expect(spec.root.shadowRoot.querySelector('button.menu')).toBeNull();
    expect(spec.root.shadowRoot.querySelector('nav a svg')).toBeNull();
  });

  it('styles key on the reflected collapsed and open attributes', () => {
    const fs = require('fs');
    const path = require('path');
    const css = fs.readFileSync(path.join(__dirname, 'app-header.css'), 'utf8');
    expect(css).toContain(":host([orientation='vertical'][collapsed])");
    expect(css).toContain(":host([orientation='vertical'][open])");
  });
});

