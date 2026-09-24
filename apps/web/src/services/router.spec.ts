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

describe('test and attempt routes', () => {
  it('resolves the static test pages', () => {
    expect(resolveRoute('/tests')).toEqual({ tag: 'page-tests' });
    expect(resolveRoute('/tests/new')).toEqual({ tag: 'page-test-editor', testId: undefined });
    // page-library now serves both segments and is switched by a reflected
    // prop, so the route always names which one.
    expect(resolveRoute('/library')).toEqual({ tag: 'page-library', kind: 'tests' });
  });

  it('parses /tests/:id and its sub-pages', () => {
    expect(resolveRoute('/tests/5')).toEqual({ tag: 'page-test', testId: 5 });
    expect(resolveRoute('/tests/5/edit')).toEqual({ tag: 'page-test-editor', testId: 5 });
    expect(resolveRoute('/tests/5/assign')).toEqual({ tag: 'page-test-assign', testId: 5 });
    expect(resolveRoute('/tests/5/results')).toEqual({ tag: 'page-test-results', testId: 5 });
    expect(resolveRoute('/tests/5/print')).toEqual({ tag: 'page-test-print', testId: 5 });
    expect(resolveRoute('/tests/abc')).toEqual({ tag: 'page-test', testId: undefined });
    expect(resolveRoute('/tests/5/nope').tag).toBe('page-home');
    expect(resolveRoute('/tests/5/edit/extra').tag).toBe('page-home');
  });

  it('parses /attempts/:id', () => {
    expect(resolveRoute('/attempts/9')).toEqual({ tag: 'page-attempt', attemptId: 9 });
    expect(resolveRoute('/attempts/x')).toEqual({ tag: 'page-attempt', attemptId: undefined });
  });

  it('guards the authenticated test pages and leaves the public ones open', () => {
    for (const path of ['/tests', '/tests/new', '/tests/5/edit', '/tests/5/assign', '/tests/5/results', '/attempts/9']) {
      expect(redirectFor(path, null)).toBe('/login');
      expect(redirectFor(path, unverified)).toBe('/verify-email');
    }
    for (const path of ['/library', '/tests/5', '/tests/5/print']) {
      expect(redirectFor(path, null)).toBeNull();
      expect(redirectFor(path, unverified)).toBeNull();
    }
  });
});

describe('material routes', () => {
  it('resolves the static material pages', () => {
    expect(resolveRoute('/materials')).toEqual({ tag: 'page-materials' });
    expect(resolveRoute('/materials/new')).toEqual({ tag: 'page-material-form', materialId: undefined });
    expect(resolveRoute('/library/materials')).toEqual({ tag: 'page-library', kind: 'materials' });
  });

  it('parses /materials/:id and its sub-pages', () => {
    expect(resolveRoute('/materials/7')).toEqual({ tag: 'page-material', materialId: 7 });
    expect(resolveRoute('/materials/7/edit')).toEqual({ tag: 'page-material-form', materialId: 7 });
    expect(resolveRoute('/materials/7/share')).toEqual({ tag: 'page-material-share', materialId: 7 });
    expect(resolveRoute('/materials/abc')).toEqual({ tag: 'page-material', materialId: undefined });
    expect(resolveRoute('/materials/-1')).toEqual({ tag: 'page-material', materialId: undefined });
    expect(resolveRoute('/materials/7/nope').tag).toBe('page-home');
    expect(resolveRoute('/materials/7/edit/extra').tag).toBe('page-home');
  });

  it('treats /materials/shared as an unknown material rather than a page', () => {
    // /materials/shared is an API path only; the SPA has no such route, so it
    // must land on page-material with no id (the not-found state) and never
    // swallow the exact /materials case.
    expect(resolveRoute('/materials/shared')).toEqual({ tag: 'page-material', materialId: undefined });
  });

  it('guards the authenticated material pages and leaves the public ones open', () => {
    for (const path of ['/materials', '/materials/new', '/materials/7/edit', '/materials/7/share']) {
      expect(redirectFor(path, null)).toBe('/login');
      expect(redirectFor(path, unverified)).toBe('/verify-email');
    }
    for (const path of ['/materials/7', '/library/materials']) {
      expect(redirectFor(path, null)).toBeNull();
      expect(redirectFor(path, unverified)).toBeNull();
    }
  });

  it('does not let /materials/new read as a public material page', () => {
    // It parses through materialRoute() as a (bogus) /materials/:id with id
    // "new" -- exactly the /tests/new hazard -- so it has to be excluded
    // before isPublic() consults the helper.
    expect(redirectFor('/materials/new', unverified)).toBe('/verify-email');
  });

  it('lets a verified user reach every material page', () => {
    for (const path of ['/materials', '/materials/new', '/materials/7', '/materials/7/edit', '/materials/7/share', '/library/materials']) {
      expect(redirectFor(path, verified)).toBeNull();
    }
  });
});

describe('generation routes', () => {
  it('resolves the two static generation pages', () => {
    expect(resolveRoute('/integrations')).toEqual({ tag: 'page-integrations' });
    // Must be matched BEFORE testRoute(), which would otherwise read
    // /tests/generate as a (bogus) /tests/:id with id "generate" and hand it
    // to the PUBLIC page-test.
    expect(resolveRoute('/tests/generate')).toEqual({ tag: 'page-test-generate' });
    expect(resolveRoute('/tests/generate').tag).not.toBe('page-test');
  });

  it('parses /generations/:id like /attempts/:id', () => {
    expect(resolveRoute('/generations/7')).toEqual({ tag: 'page-generation', generationId: 7 });
    expect(resolveRoute('/generations/x')).toEqual({ tag: 'page-generation', generationId: undefined });
    expect(resolveRoute('/generations/-1')).toEqual({ tag: 'page-generation', generationId: undefined });
    expect(resolveRoute('/generations/7/extra').tag).toBe('page-home');
  });

  it('guards all three as auth-only', () => {
    for (const path of ['/integrations', '/tests/generate', '/generations/7']) {
      expect(redirectFor(path, null)).toBe('/login');
      expect(redirectFor(path, unverified)).toBe('/verify-email');
      expect(redirectFor(path, verified)).toBeNull();
    }
  });

  it('does not let /tests/generate read as a public test page', () => {
    // The same hazard as /tests/new and /materials/new: it parses through
    // testRoute() as /tests/:id, which isPublic() would treat as the public
    // single-test view and exempt from the verification gate.
    expect(redirectFor('/tests/generate', unverified)).toBe('/verify-email');
    expect(redirectFor('/tests/generate', null)).toBe('/login');
  });
});
