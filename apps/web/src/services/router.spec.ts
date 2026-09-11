import { redirectFor, resolveRoute } from './router';

const verified = { id: 1, email_verified_at: '2026-01-01' } as any;
const unverified = { id: 1, email_verified_at: null } as any;

describe('resolveRoute', () => {
  it('maps static paths to their page tags', () => {
    expect(resolveRoute('/login').tag).toBe('page-login');
    expect(resolveRoute('/profile').tag).toBe('page-profile');
    expect(resolveRoute('/teachers').tag).toBe('page-teachers');
    expect(resolveRoute('/nonsense').tag).toBe('page-home');
  });

  it('parses the teacher id out of /teachers/:id', () => {
    expect(resolveRoute('/teachers/42')).toEqual({ tag: 'page-teacher-profile', teacherId: 42 });
  });

  it('leaves teacherId undefined for a non-numeric segment', () => {
    expect(resolveRoute('/teachers/abc')).toEqual({ tag: 'page-teacher-profile', teacherId: undefined });
  });

  it('leaves teacherId undefined for negative, non-integer, and missing segments', () => {
    // page-teacher-profile (Task 10) renders its not-found state off teacherId === undefined,
    // so rejecting bad input here is load-bearing for the next task, not just polish.
    expect(resolveRoute('/teachers/-1')).toEqual({ tag: 'page-teacher-profile', teacherId: undefined });
    expect(resolveRoute('/teachers/1.5')).toEqual({ tag: 'page-teacher-profile', teacherId: undefined });
    expect(resolveRoute('/teachers/')).toEqual({ tag: 'page-teacher-profile', teacherId: undefined });
  });
});

describe('redirectFor', () => {
  it('bounces signed-in users off guest-only pages', () => {
    expect(redirectFor('/login', verified)).toBe('/');
  });

  it('does not bounce signed-out visitors off guest-only pages', () => {
    // Guards a severe mutant: dropping the `user &&` prefix on the guest-only check
    // would bounce signed-out visitors off /login too, making the app permanently
    // unreachable for anyone who isn't already signed in.
    expect(redirectFor('/login', null)).toBeNull();
    expect(redirectFor('/register', null)).toBeNull();
  });

  it('sends signed-out users away from auth-only pages', () => {
    expect(redirectFor('/profile', null)).toBe('/login');
  });

  it('steers unverified users to the verification notice', () => {
    expect(redirectFor('/', unverified)).toBe('/verify-email');
  });

  it('steers a signed-in unverified user off an auth-only page too', () => {
    // Auth-only does not fire (a user exists), so the verification gate is what
    // actually redirects here — a real guard axis next to the auth-only check.
    expect(redirectFor('/profile', unverified)).toBe('/verify-email');
  });

  it('lets unverified users browse the public directory', () => {
    // user is truthy here, so this is the test that actually reaches isPublic()
    // inside the verification-gate branch.
    expect(redirectFor('/teachers', unverified)).toBeNull();
    expect(redirectFor('/teachers/42', unverified)).toBeNull();
  });

  it('does not treat public paths as guest-only or auth-only', () => {
    // NOTE: with user = null, the verification gate's `user &&` prefix short-circuits
    // before isPublic() is ever evaluated, so this test cannot exercise the /teachers
    // exemption mechanism — that's covered by 'lets unverified users browse the public
    // directory' above, where user is truthy. This test only proves /teachers and
    // /teachers/:id are absent from GUEST_ONLY/AUTH_ONLY.
    expect(redirectFor('/teachers', null)).toBeNull();
    expect(redirectFor('/teachers/42', null)).toBeNull();
  });

  it('does not redirect a verified user browsing normally', () => {
    expect(redirectFor('/', verified)).toBeNull();
    expect(redirectFor('/profile', verified)).toBeNull();
  });
});

describe('router B2 routes', () => {
  it('resolves the connections and notifications pages', () => {
    expect(resolveRoute('/connections').tag).toBe('page-connections');
    expect(resolveRoute('/notifications').tag).toBe('page-notifications');
  });

  it('sends signed-out visitors away from both', () => {
    expect(redirectFor('/connections', null)).toBe('/login');
    expect(redirectFor('/notifications', null)).toBe('/login');
  });

  it('lets a verified user reach both', () => {
    // Proves the guard is signed-out-only rather than blocking everyone.
    const verified = { id: 1, email_verified_at: '2026-01-01' } as any;
    expect(redirectFor('/connections', verified)).toBeNull();
    expect(redirectFor('/notifications', verified)).toBeNull();
  });

  it('still steers an unverified user to verification', () => {
    const unverified = { id: 1, email_verified_at: null } as any;
    expect(redirectFor('/connections', unverified)).toBe('/verify-email');
  });
});
