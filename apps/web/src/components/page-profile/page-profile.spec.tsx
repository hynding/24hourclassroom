import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const myProfile = jest.fn();
const save = jest.fn();
const uploadAvatar = jest.fn();
const removeAvatar = jest.fn().mockResolvedValue(undefined);

jest.mock('../../services/profile-store', () => ({
  profileStore: {
    myProfile: (...a: unknown[]) => myProfile(...a),
    save: (...a: unknown[]) => save(...a),
    uploadAvatar: (...a: unknown[]) => uploadAvatar(...a),
    removeAvatar: (...a: unknown[]) => removeAvatar(...a),
  },
}));

// Imported after jest.mock(): Stencil's Jest preprocessor transpiles via the
// TypeScript compiler, not babel-jest, so jest.mock() calls are not hoisted
// above static imports the way they are under babel-jest. Without this
// ordering, './page-profile' (and its real profile-store import) resolves
// before the mock is registered, and the component hits the real ApiClient.
import { PageProfile } from './page-profile';

const emptyProfile = { bio: null, school: null, specialties: null, subjects: [], grade_levels: [], avatar_url: null };

describe('page-profile', () => {
  // These jest.fn()s are module-level and shared across every test in this
  // file, and this project has no global clearMocks/resetMocks. Clear call
  // history before each test so assertions reflect that test's behavior,
  // not leftover calls from a previous one.
  beforeEach(() => {
    myProfile.mockClear();
    save.mockClear();
    uploadAvatar.mockClear();
    removeAvatar.mockClear();

    myProfile.mockResolvedValue({ ...emptyProfile, school: 'Rivet High' });
    save.mockResolvedValue({ ...emptyProfile, school: 'Rivet High' });
    removeAvatar.mockResolvedValue(undefined);
  });

  it('loads the current profile into the form', async () => {
    const spec = await newSpecPage({ components: [PageProfile], html: '<page-profile></page-profile>' });
    await spec.waitForChanges();

    expect(spec.rootInstance.school).toBe('Rivet High');
  });

  it('saves the form and reports success', async () => {
    const spec = await newSpecPage({ components: [PageProfile], html: '<page-profile></page-profile>' });
    await spec.waitForChanges();

    spec.rootInstance.bio = 'I teach math.';
    await spec.rootInstance.submit(new Event('submit'));
    await spec.waitForChanges();

    expect(save).toHaveBeenCalledWith(expect.objectContaining({ bio: 'I teach math.', school: 'Rivet High' }));
    expect(spec.root.shadowRoot.textContent).toContain('Saved');
  });

  it('surfaces field errors from a 422', async () => {
    save.mockRejectedValue(new ApiError(422, 'invalid', { bio: ['The bio is too long.'] }));

    const spec = await newSpecPage({ components: [PageProfile], html: '<page-profile></page-profile>' });
    await spec.waitForChanges();

    await spec.rootInstance.submit(new Event('submit'));
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('The bio is too long.');
  });

  it('removes the avatar', async () => {
    myProfile.mockResolvedValue({ ...emptyProfile, avatar_url: 'https://api.test/storage/avatars/x.jpg' });

    const spec = await newSpecPage({ components: [PageProfile], html: '<page-profile></page-profile>' });
    await spec.waitForChanges();
    expect(spec.rootInstance.avatarUrl).not.toBeNull();

    await spec.rootInstance.removeAvatar();
    await spec.waitForChanges();

    expect(removeAvatar).toHaveBeenCalled();
    expect(spec.rootInstance.avatarUrl).toBeNull();
  });

  it('surfaces an error and keeps the avatar displayed when removal fails', async () => {
    myProfile.mockResolvedValue({ ...emptyProfile, avatar_url: 'https://api.test/storage/avatars/x.jpg' });
    removeAvatar.mockRejectedValue(new ApiError(500, 'Server Error'));

    const spec = await newSpecPage({ components: [PageProfile], html: '<page-profile></page-profile>' });
    await spec.waitForChanges();

    await spec.rootInstance.removeAvatar();
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Server Error');
    expect(spec.rootInstance.avatarUrl).toBe('https://api.test/storage/avatars/x.jpg');
  });

  it('toggles a subject on and off', async () => {
    const spec = await newSpecPage({ components: [PageProfile], html: '<page-profile></page-profile>' });
    await spec.waitForChanges();

    spec.rootInstance.toggleSubject('math');
    expect(spec.rootInstance.subjects).toEqual(['math']);

    spec.rootInstance.toggleSubject('math');
    expect(spec.rootInstance.subjects).toEqual([]);
  });
});
