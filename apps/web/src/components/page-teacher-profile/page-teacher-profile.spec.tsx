import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const teacher = jest.fn();
const follow = jest.fn();
const unfollow = jest.fn();
const requestConnection = jest.fn();
const acceptConnection = jest.fn();
const removeConnection = jest.fn();
const recoverFromExpiredSession = jest.fn();

jest.mock('../../services/profile-store', () => ({
  profileStore: {
    teacher: (...args: unknown[]) => teacher(...args),
    follow: (...args: unknown[]) => follow(...args),
    unfollow: (...args: unknown[]) => unfollow(...args),
    requestConnection: (...args: unknown[]) => requestConnection(...args),
    acceptConnection: (...args: unknown[]) => acceptConnection(...args),
    removeConnection: (...args: unknown[]) => removeConnection(...args),
  },
}));

// mockCurrentUser is read lazily through the getter below, so it can be
// reassigned per test without re-registering the mock module.
let mockCurrentUser: { id: number; email_verified_at: string | null; role: string } | null = null;

jest.mock('../../services/auth-store', () => ({
  authStore: {
    get currentUser() {
      return mockCurrentUser;
    },
  },
}));

jest.mock('../../services/session-recovery', () => ({
  recoverFromExpiredSession: (...a: unknown[]) => recoverFromExpiredSession(...a),
}));

// Imported after jest.mock(): Stencil's Jest preprocessor transpiles via the
// TypeScript compiler, not babel-jest, so jest.mock() calls are not hoisted
// above static imports the way they are under babel-jest. Without this
// ordering, './page-teacher-profile' (and its real profile-store import)
// resolves before the mock is registered, and the component hits the real
// ApiClient.
import { PageTeacherProfile } from './page-teacher-profile';

describe('page-teacher-profile', () => {
  // `teacher` is a single jest.fn() shared across every test in this file,
  // and this project has no global clearMocks/resetMocks. Without a reset,
  // the "id is missing" test's `expect(teacher).not.toHaveBeenCalled()`
  // would fail from calls made by earlier tests, not from real behavior.
  beforeEach(() => {
    teacher.mockClear();
    follow.mockClear();
    unfollow.mockClear();
    requestConnection.mockClear();
    acceptConnection.mockClear();
    removeConnection.mockClear();
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
    // A VERIFIED viewer who is not the subject, by default. The server only
    // sends a boolean `is_following` to an authenticated viewer, so the
    // control-rendering tests below were never really exercising a guest;
    // and the controls now also require a verified email (B3), so the
    // default has to carry one or every one of them hides for the wrong
    // reason.
    mockCurrentUser = { id: 999, email_verified_at: '2026-01-01T00:00:00Z', role: 'teacher' };
  });

  it('renders the teacher and their profile', async () => {
    teacher.mockResolvedValue({
      id: 7, name: 'Ada Teacher', role: 'teacher',
      profile: { bio: 'I teach math.', school: 'Rivet High', specialties: 'Robotics', subjects: ['math'], grade_levels: ['9-12'], avatar_url: null },
    });

    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="7"></page-teacher-profile>',
    });
    await spec.waitForChanges();

    expect(teacher).toHaveBeenCalledWith(7);
    expect(spec.root.shadowRoot.textContent).toContain('Ada Teacher');
    expect(spec.root.shadowRoot.textContent).toContain('I teach math.');
  });

  it('renders a not-found state when the api 404s', async () => {
    teacher.mockRejectedValue(new ApiError(404, 'Not Found'));

    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="999"></page-teacher-profile>',
    });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('We could not find that teacher.');
  });

  it('renders a distinct error state when the api fails for a non-404 reason', async () => {
    teacher.mockRejectedValue(new ApiError(500, 'Server Error'));

    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="7"></page-teacher-profile>',
    });
    await spec.waitForChanges();

    const text = spec.root.shadowRoot.textContent;
    expect(text).toContain("We could not load that teacher's profile.");
    expect(text).not.toContain('We could not find that teacher.');
  });

  it('renders a not-found state when the id is missing', async () => {
    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile></page-teacher-profile>',
    });
    await spec.waitForChanges();

    expect(teacher).not.toHaveBeenCalled();
    expect(spec.root.shadowRoot.textContent).toContain ('We could not find that teacher.');
  });

  // A student viewed by an accepted connection comes back name-only: no
  // `profile`, `is_following`, or `connection` keys at all -- not an empty
  // object or explicit nulls, the absence is the case. Confirmed against
  // PublicProfileController's student branch, which returns exactly
  // {id, name, role}. page-teacher-profile previously destructured `profile`
  // off the payload unguarded and dereferenced `profile.avatar_url` etc.,
  // which throws when `profile` is undefined. This is reachable: the SPA
  // only links teachers, but a teacher who is an accepted connection of a
  // student can hand-type `/teachers/<student-id>`.
  //
  // The fixture below deliberately omits is_following/connection (rather
  // than setting them to null, as an earlier version of this test did) so
  // it also exercises the render guard: a strict `!== null` check treats
  // `undefined` as present and would render Follow/Connect controls on this
  // exact name-only payload, offering actions the API then rejects.
  it('renders a name-only profile without crashing, and with no controls, when the viewer state is absent', async () => {
    teacher.mockResolvedValue({
      id: 9, name: 'Sam Student', role: 'student',
    });

    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="9"></page-teacher-profile>',
    });
    await spec.waitForChanges();

    const text = spec.root.shadowRoot.textContent;
    expect(text).toContain('Sam Student');
    expect(text).not.toContain('Follow');
    expect(text).not.toContain('Connect');
  });

  const withViewerState = (state: Record<string, unknown>) => {
    teacher.mockResolvedValue({
      id: 7, name: 'Ada Teacher', role: 'teacher',
      profile: { bio: null, school: null, specialties: null, subjects: [], grade_levels: [], avatar_url: null },
      is_following: false, connection: null, ...state,
    });
    return newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="7"></page-teacher-profile>',
    });
  };

  it('offers Connect when there is no connection', async () => {
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Connect');
    expect(text).not.toContain('Accept');
    expect(text).not.toContain('Disconnect');
    expect(text).not.toContain('Cancel request');
  });

  it('offers Cancel request on an outgoing pending connection', async () => {
    const spec = await withViewerState({ connection: { id: 3, status: 'pending', direction: 'outgoing' } });
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Cancel request');
    // Offering Accept here would send a PATCH the API answers with 403.
    expect(text).not.toContain('Accept');
  });

  it('offers Accept on an incoming pending connection', async () => {
    const spec = await withViewerState({ connection: { id: 3, status: 'pending', direction: 'incoming' } });
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Accept');
    expect(text).not.toContain('Cancel request');
  });

  it('offers Disconnect on an accepted connection', async () => {
    const spec = await withViewerState({ connection: { id: 3, status: 'accepted', direction: 'outgoing' } });
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Disconnect');
    // Plain 'Connect' (no trailing space): 'Disconnect'.includes('Connect')
    // is already false since the substring's leading 'c' is lowercase, so
    // this loses nothing against the real "Disconnect" label while still
    // catching a stray, always-rendered "Connect" button next to it.
    expect(text).not.toContain('Connect');
  });

  it('shows no controls at all to a logged-out visitor', async () => {
    mockCurrentUser = null;
    const spec = await withViewerState({ is_following: null, connection: null });
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).not.toContain('Follow');
    expect(text).not.toContain('Connect');
  });

  it('follows and refetches so the button reflects server state', async () => {
    const spec = await withViewerState({});
    await spec.waitForChanges();

    await spec.rootInstance.toggleFollow();

    expect(follow).toHaveBeenCalledWith(7);
    // Refetched rather than toggled locally: the button must show what the
    // server believes, not what the click assumed.
    expect(teacher).toHaveBeenCalledTimes(2);
  });

  it('unfollows when already following', async () => {
    const spec = await withViewerState({ is_following: true });
    await spec.waitForChanges();

    await spec.rootInstance.toggleFollow();

    expect(unfollow).toHaveBeenCalledWith(7);
    expect(follow).not.toHaveBeenCalled();
  });

  // A teacher can reach their own /teachers/<id> through ordinary navigation
  // (the directory has no self-exclusion), and the payload they get back
  // for themself is state-identical to "unconnected other teacher"
  // (is_following: false, connection: null). Without a viewer/subject
  // comparison, that renders Follow/Connect controls a click on which the
  // API rejects (follow and connect both refuse self-targeting).
  it('shows no controls on the viewer\'s own profile', async () => {
    mockCurrentUser = { id: 7, email_verified_at: '2026-01-01T00:00:00Z', role: 'teacher' };
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).not.toContain('Follow');
    expect(text).not.toContain('Connect');
  });

  it('still offers controls to a signed-in viewer looking at someone else', async () => {
    mockCurrentUser = { id: 999, email_verified_at: '2026-01-01T00:00:00Z', role: 'teacher' };
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Follow');
    expect(text).toContain('Connect');
    // The verification hint is scoped to an UNVERIFIED viewer, not shown
    // alongside working controls.
    expect(spec.root.shadowRoot.querySelector('[data-testid="verify-hint"]')).toBeNull();
  });

  // A stale tab whose connection state changed elsewhere (e.g. accepted or
  // cancelled from another tab) can still click a now-invalid action button
  // and get a 422 back. toggleFollow/connectAction must not let that reject
  // unhandled -- they should recover the same way every other action-bearing
  // page in this app does: delegate a session-expiry (401) to
  // recoverFromExpiredSession, and otherwise resync by reloading so the
  // controls reflect what the server now believes.
  it('recovers from a failed follow action by resyncing rather than throwing', async () => {
    const spec = await withViewerState({});
    await spec.waitForChanges();
    follow.mockRejectedValueOnce(new ApiError(422, 'Unprocessable'));

    await expect(spec.rootInstance.toggleFollow()).resolves.toBeUndefined();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    // Initial load in withViewerState() + a resync reload after the failed
    // action: the controls must reflect server truth, not the stale local
    // state the click assumed.
    expect(teacher).toHaveBeenCalledTimes(2);
  });

  it('delegates a 401 from a failed action to session recovery without resyncing again', async () => {
    const spec = await withViewerState({});
    await spec.waitForChanges();
    follow.mockRejectedValueOnce(new ApiError(401, 'Unauthenticated.'));
    recoverFromExpiredSession.mockReturnValue(true);

    await expect(spec.rootInstance.toggleFollow()).resolves.toBeUndefined();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    // Session recovery already navigates away; reloading this now-invalid
    // session's data on top of that would be wasted work at best.
    expect(teacher).toHaveBeenCalledTimes(1);
  });

  // B3. /teachers/{id} is exempt from the verification redirect (isPublic()
  // in router.ts) and PublicProfileController is not behind `verified`, so
  // an unverified viewer gets `is_following: false` -- a boolean, not null
  // -- and the `!= null` render guard let the controls through. The click
  // then hits `verified` and 403s; 403 is not a recovery case, so the page
  // resynced to the identical state. No error, no explanation, a button
  // that just looks broken.
  it('tells an unverified viewer to verify instead of offering controls that 403', async () => {
    mockCurrentUser = { id: 999, email_verified_at: null, role: 'teacher' };
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(spec.root.shadowRoot.querySelector('[data-testid="verify-hint"]')).not.toBeNull();
    expect(text).not.toContain('Follow');
    expect(text).not.toContain('Connect');
  });

  it('does not nag a verified viewer looking at their own profile to verify', async () => {
    // The hint belongs inside the same branch the controls do, so a
    // self-viewer -- who gets no controls for a different reason -- is not
    // told to verify an address they have already verified.
    mockCurrentUser = { id: 7, email_verified_at: '2026-01-01T00:00:00Z', role: 'teacher' };
    const spec = await withViewerState({});
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.querySelector('[data-testid="verify-hint"]')).toBeNull();
  });

  // N4. The server enforces connections as teacher<->teacher or
  // teacher<->student (spec line 14), guarding the ACTOR as well as the
  // target, so an admin's Connect click 404s. 404 is not a recovery case,
  // so connectAction() resyncs to the identical state and the button just
  // looks live while doing nothing -- the same dead affordance B3 fixed for
  // unverified viewers.
  const admin = { id: 999, email_verified_at: '2026-01-01T00:00:00Z', role: 'admin' };

  it('does not offer Connect to an admin viewer, but still offers Follow', async () => {
    mockCurrentUser = admin;
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).not.toContain('Connect');
    expect(spec.root.shadowRoot.querySelector('[data-testid="admin-connect-hint"]')).not.toBeNull();
    // Load-bearing: the spec permits "anyone -> teachers" for follow, and a
    // promoted admin can still follow. Hiding both controls would break a
    // working feature to fix a dead one.
    expect(text).toContain('Follow');
  });

  it('still offers Connect to a teacher viewer on the identical payload', async () => {
    // The discriminator: same profile, same viewer state, same verified
    // email, same id -- only `role` differs. Without it this pair would
    // prove nothing about roles.
    mockCurrentUser = { ...admin, role: 'teacher' };
    const spec = await withViewerState({});
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Connect');
    expect(spec.root.shadowRoot.querySelector('[data-testid="admin-connect-hint"]')).toBeNull();
  });

  it('still offers Disconnect to an admin on a pre-existing connection', async () => {
    // The role rules are enforced at CREATION time only, and the verifier
    // confirmed an admin can still read, accept, cancel and delete existing
    // rows. Only the initiate affordance is dead, so this must not
    // degenerate into "admins get no connection controls".
    mockCurrentUser = admin;
    const spec = await withViewerState({ connection: { id: 3, status: 'accepted', direction: 'outgoing' } });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Disconnect');
    expect(spec.root.shadowRoot.querySelector('[data-testid="admin-connect-hint"]')).toBeNull();
  });

  it('still offers Accept to an admin on an incoming pending connection', async () => {
    mockCurrentUser = admin;
    const spec = await withViewerState({ connection: { id: 3, status: 'pending', direction: 'incoming' } });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Accept');
    expect(spec.root.shadowRoot.querySelector('[data-testid="admin-connect-hint"]')).toBeNull();
  });

  it('does not show the admin hint to an unverified admin, who sees the verify hint', async () => {
    // The two hints are mutually exclusive: verification is the outer
    // question, and telling someone both at once is noise.
    mockCurrentUser = { ...admin, email_verified_at: null };
    const spec = await withViewerState({});
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.querySelector('[data-testid="verify-hint"]')).not.toBeNull();
    expect(spec.root.shadowRoot.querySelector('[data-testid="admin-connect-hint"]')).toBeNull();
  });

  it('renders every subject and grade as a pill', async () => {
    teacher.mockResolvedValue({
      id: 7, name: 'Ada Teacher', role: 'teacher', is_following: false, connection: null,
      profile: { bio: null, school: null, specialties: null, subjects: ['math', 'science'], grade_levels: ['9-12'], avatar_url: null },
    });

    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="7"></page-teacher-profile>',
    });
    await spec.waitForChanges();

    // Exact count: a pill class on the <ul> instead of each <li>, or a
    // missing grade, both fail.
    expect(spec.root.shadowRoot.querySelectorAll('.pill')).toHaveLength(3);
  });
});
