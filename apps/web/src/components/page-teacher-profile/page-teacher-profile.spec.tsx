import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const teacher = jest.fn();
const follow = jest.fn();
const unfollow = jest.fn();
const requestConnection = jest.fn();
const acceptConnection = jest.fn();
const removeConnection = jest.fn();

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
let mockCurrentUser: { id: number } | null = null;

jest.mock('../../services/auth-store', () => ({
  authStore: {
    get currentUser() {
      return mockCurrentUser;
    },
  },
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
    mockCurrentUser = null;
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
    expect(text).not.toContain('Connect ');
  });

  it('shows no controls at all to a logged-out visitor', async () => {
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
    mockCurrentUser = { id: 7 };
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).not.toContain('Follow');
    expect(text).not.toContain('Connect');
  });

  it('still offers controls to a signed-in viewer looking at someone else', async () => {
    mockCurrentUser = { id: 999 };
    const spec = await withViewerState({});
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Follow');
    expect(text).toContain('Connect');
  });
});
