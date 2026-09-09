import { ProfileStore, attachAuthInvalidation } from './profile-store';

const profile = {
  bio: 'hi', school: 'Rivet High', specialties: null,
  subjects: ['math'], grade_levels: ['9-12'], avatar_url: null,
} as any;

const clientMock = () => ({
  getTeachers: jest.fn().mockResolvedValue({ data: [], meta: {} }),
  getPublicProfile: jest.fn().mockResolvedValue({ id: 1, name: 'Ada', role: 'teacher', profile }),
  getProfile: jest.fn().mockResolvedValue(profile),
  updateProfile: jest.fn().mockResolvedValue({ ...profile, school: 'New' }),
  uploadAvatar: jest.fn().mockResolvedValue({ ...profile, avatar_url: 'u' }),
  deleteAvatar: jest.fn().mockResolvedValue(undefined),
});

describe('profile-store', () => {
  it('myProfile caches after the first call', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);

    await store.myProfile();
    const second = await store.myProfile();

    expect(client.getProfile).toHaveBeenCalledTimes(1);
    expect(second.school).toBe('Rivet High');
  });

  it('save replaces the cached profile', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);
    await store.myProfile();

    const saved = await store.save({ school: 'New' });

    expect(client.updateProfile).toHaveBeenCalledWith({ school: 'New' });
    expect(saved.school).toBe('New');
    expect((await store.myProfile()).school).toBe('New');
    expect(client.getProfile).toHaveBeenCalledTimes(1);
  });

  it('uploadAvatar replaces the cached profile', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);
    const file = new File(['x'], 'me.jpg');

    const updated = await store.uploadAvatar(file);

    expect(client.uploadAvatar).toHaveBeenCalledWith(file);
    expect(updated.avatar_url).toBe('u');
    expect((await store.myProfile()).avatar_url).toBe('u');
  });

  it('removeAvatar clears the cached avatar without refetching', async () => {
    const client = clientMock();
    // Sentinel distinct from null: if removeAvatar refetched via getProfile,
    // the cache would pick up this value instead of being cleared locally.
    client.getProfile.mockResolvedValue({ ...profile, avatar_url: 'https://api.test/storage/avatars/refetched.jpg' });
    const store = new ProfileStore(client as any);
    await store.uploadAvatar(new File(['x'], 'me.jpg'));

    await store.removeAvatar();

    expect(client.deleteAvatar).toHaveBeenCalled();
    expect(client.getProfile).not.toHaveBeenCalled();
    expect((await store.myProfile()).avatar_url).toBeNull();
  });

  it('passes filters through to the client', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);

    await store.searchTeachers({ subject: 'math' });

    expect(client.getTeachers).toHaveBeenCalledWith({ subject: 'math' });
  });

  it('teacher fetches a public profile by id', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);

    const result = await store.teacher(1);

    expect(client.getPublicProfile).toHaveBeenCalledWith(1);
    expect(result).toEqual({ id: 1, name: 'Ada', role: 'teacher', profile });
  });

  it('drops the cache when the auth store notifies (e.g. logout or user switch)', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);
    let listener: (user: unknown) => void = () => {};
    const fakeAuth = {
      subscribe: jest.fn((fn: (user: unknown) => void) => {
        listener = fn;
        return () => {};
      }),
    };
    attachAuthInvalidation(fakeAuth as any, store);

    await store.myProfile();
    listener(null);
    await store.myProfile();

    expect(client.getProfile).toHaveBeenCalledTimes(2);
  });
});
