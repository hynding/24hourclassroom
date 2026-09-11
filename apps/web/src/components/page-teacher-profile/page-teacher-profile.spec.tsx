import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const teacher = jest.fn();

jest.mock('../../services/profile-store', () => ({
  profileStore: {
    teacher: (...args: unknown[]) => teacher(...args),
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
  // `profile` key at all (not an empty object -- the absence is the case).
  // page-teacher-profile previously destructured `profile` off the payload
  // unguarded and dereferenced `profile.avatar_url` etc., which throws when
  // `profile` is undefined. This is reachable: the SPA only links teachers,
  // but a teacher who is an accepted connection of a student can hand-type
  // `/teachers/<student-id>`.
  it('renders a name-only profile without crashing when profile is absent', async () => {
    teacher.mockResolvedValue({
      id: 9, name: 'Sam Student', role: 'student',
      is_following: false, connection: null,
    });

    const spec = await newSpecPage({
      components: [PageTeacherProfile],
      html: '<page-teacher-profile teacher-id="9"></page-teacher-profile>',
    });
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Sam Student');
  });
});
