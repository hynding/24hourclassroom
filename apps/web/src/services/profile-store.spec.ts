import { ProfileStore, attachAuthInvalidation } from './profile-store';
import { StaleIdentityError } from './stale-identity';

const profile = {
  bio: 'hi', school: 'Rivet High', specialties: null,
  subjects: ['math'], grade_levels: ['9-12'], avatar_url: null,
} as any;

const clientMock = () => ({
  getTeachers: jest.fn().mockResolvedValue({ data: [], meta: {} }),
  getPublicProfile: jest.fn().mockResolvedValue({ id: 1, name: 'Ada', role: 'teacher', profile }),
  getProfile: jest.fn().mockResolvedValue(profile),
  updateProfile: jest.fn().mockResolvedValue({ ...profile, school: 'Rivet High (saved)' }),
  uploadAvatar: jest.fn().mockResolvedValue({ ...profile, avatar_url: 'u' }),
  deleteAvatar: jest.fn().mockResolvedValue(undefined),
  getConnections: jest.fn().mockResolvedValue({ data: [] }),
  getPendingConnections: jest.fn().mockResolvedValue({ incoming: [], outgoing: [] }),
  followTeacher: jest.fn().mockResolvedValue(undefined),
  unfollowTeacher: jest.fn().mockResolvedValue(undefined),
  requestConnection: jest.fn().mockResolvedValue(undefined),
  acceptConnection: jest.fn().mockResolvedValue(undefined),
  removeConnection: jest.fn().mockResolvedValue(undefined),
  getNotifications: jest.fn().mockResolvedValue({ data: [], meta: {} }),
  getUnreadCount: jest.fn().mockResolvedValue(3),
  markNotificationsRead: jest.fn().mockResolvedValue(undefined),
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
    // The mock's resolved value is distinguishable from the input so this
    // assertion can only pass if save() returns the client's response.
    expect(saved.school).toBe('Rivet High (saved)');
    expect((await store.myProfile()).school).toBe('Rivet High (saved)');
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

  it('does not let an in-flight fetch win a race against a clear() that lands before it resolves', async () => {
    const client = clientMock();
    let resolveFetch: (value: typeof profile) => void;
    client.getProfile.mockImplementationOnce(
      () => new Promise((resolve) => { resolveFetch = resolve; }),
    );
    const store = new ProfileStore(client as any);

    // Start a fetch for the current identity, then invalidate (as the
    // auth-invalidation listener would on logout/user switch) before that
    // fetch resolves.
    const inFlight = store.myProfile();
    store.clear();
    resolveFetch!(profile);

    // The generation guard protected the cache write but returned the
    // pre-clear() value anyway, so the CALLER still received the previous
    // identity's profile and assigned it. The guard has to reject, not
    // just decline to cache.
    await expect(inFlight).rejects.toBeInstanceOf(StaleIdentityError);

    // A subsequent myProfile() must re-fetch rather than serving the stale
    // response the in-flight call just tried to cache.
    client.getProfile.mockResolvedValueOnce({ ...profile, school: 'Refetched' });
    const second = await store.myProfile();

    expect(client.getProfile).toHaveBeenCalledTimes(2);
    expect(second.school).toBe('Refetched');
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

  it('does not let an in-flight save win a race against a clear()', async () => {
    const client = clientMock();
    let resolveSave: (value: typeof profile) => void;
    client.updateProfile.mockImplementationOnce(
      () => new Promise((resolve) => { resolveSave = resolve; }),
    );
    const store = new ProfileStore(client as any);

    const inFlight = store.save({ school: 'New' });
    store.clear();
    resolveSave!({ ...profile, school: 'Stale identity' });
    await expect(inFlight).rejects.toBeInstanceOf(StaleIdentityError);

    client.getProfile.mockResolvedValueOnce({ ...profile, school: 'Refetched' });
    const after = await store.myProfile();

    expect(after.school).toBe('Refetched');
  });

  it('does not let an in-flight avatar upload win a race against a clear()', async () => {
    const client = clientMock();
    let resolveUpload: (value: typeof profile) => void;
    client.uploadAvatar.mockImplementationOnce(
      () => new Promise((resolve) => { resolveUpload = resolve; }),
    );
    const store = new ProfileStore(client as any);

    const inFlight = store.uploadAvatar(new File(['x'], 'me.jpg'));
    store.clear();
    resolveUpload!({ ...profile, avatar_url: 'stale-identity-avatar' });
    await expect(inFlight).rejects.toBeInstanceOf(StaleIdentityError);

    client.getProfile.mockResolvedValueOnce({ ...profile, avatar_url: 'fresh-avatar' });
    const after = await store.myProfile();

    expect(after.avatar_url).toBe('fresh-avatar');
  });

  it('does not let an in-flight avatar removal blank a newly cached profile', async () => {
    const client = clientMock();
    let resolveRemoval: () => void;
    client.deleteAvatar.mockImplementationOnce(
      () => new Promise<void>((resolve) => { resolveRemoval = resolve; }),
    );
    const store = new ProfileStore(client as any);
    await store.myProfile();

    // Removal starts for the current identity, then the identity changes and a
    // new profile is cached before the removal resolves.
    const inFlight = store.removeAvatar();
    store.clear();
    client.getProfile.mockResolvedValueOnce({ ...profile, avatar_url: 'next-users-avatar' });
    await store.myProfile();
    resolveRemoval!();
    await inFlight;

    // The stale removal must not blank the avatar it never applied to.
    expect((await store.myProfile()).avatar_url).toBe('next-users-avatar');
  });

  it('caches the unread count and clears it on auth change', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);

    await store.unreadCount();
    await store.unreadCount();
    expect(client.getUnreadCount).toHaveBeenCalledTimes(1);

    store.clear();
    await store.unreadCount();
    expect(client.getUnreadCount).toHaveBeenCalledTimes(2);
  });

  it('does not let an in-flight unread count win a race against a clear()', async () => {
    const client = clientMock();
    let resolveCount: (value: number) => void;
    client.getUnreadCount.mockImplementationOnce(
      () => new Promise((resolve) => { resolveCount = resolve; }),
    );
    const store = new ProfileStore(client as any);

    const inFlight = store.unreadCount();
    store.clear();
    resolveCount!(9);

    // Not just "don't cache 9" -- don't HAND 9 BACK. app-header assigns
    // whatever unreadCount() returns straight into its badge, so a
    // returned-but-uncached 9 renders user A's count in user B's header.
    await expect(inFlight).rejects.toBeInstanceOf(StaleIdentityError);

    client.getUnreadCount.mockResolvedValueOnce(0);
    expect(await store.unreadCount()).toBe(0);
  });

  it('refreshes the unread count after marking read', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);
    await store.unreadCount();

    client.getUnreadCount.mockResolvedValueOnce(0);
    await store.markRead();

    expect(client.markNotificationsRead).toHaveBeenCalled();
    expect(await store.unreadCount()).toBe(0);
  });

  it('does not let an in-flight unread count win a race against a markRead() that lands before it resolves', async () => {
    const client = clientMock();
    let resolveCount: (value: number) => void;
    client.getUnreadCount.mockImplementationOnce(
      () => new Promise((resolve) => { resolveCount = resolve; }),
    );
    const store = new ProfileStore(client as any);

    // Start a fetch for the current unread count, then mark everything read
    // (as opening the notifications page does) before that fetch resolves.
    const inFlight = store.unreadCount();
    await store.markRead();
    resolveCount!(9);

    // markRead() bumps the same generation counter clear() does, so the
    // pre-read count is refused to the caller as well as to the cache --
    // otherwise app-header would render the notifications the user has
    // just read.
    await expect(inFlight).rejects.toBeInstanceOf(StaleIdentityError);

    // A subsequent unreadCount() must re-fetch rather than serving the
    // stale pre-read count the in-flight call just tried to cache.
    client.getUnreadCount.mockResolvedValueOnce(0);
    expect(await store.unreadCount()).toBe(0);
    expect(client.getUnreadCount).toHaveBeenCalledTimes(2);
  });

  it('passes connection ids through unchanged', async () => {
    const client = clientMock();
    const store = new ProfileStore(client as any);

    await store.acceptConnection(42);
    await store.requestConnection(7);

    // Different id spaces on similar-looking URLs -- a swap deletes the
    // wrong row.
    expect(client.acceptConnection).toHaveBeenCalledWith(42);
    expect(client.requestConnection).toHaveBeenCalledWith(7);
  });

  it('still returns the value to a caller when no clear() intervenes', async () => {
    // The exclusion side of the four staleness tests above: the rejection
    // must be scoped to a raced call, not applied to every call.
    const client = clientMock();
    const store = new ProfileStore(client as any);

    await expect(store.unreadCount()).resolves.toBe(3);
    await expect(store.myProfile()).resolves.toMatchObject({ school: 'Rivet High' });
    await expect(store.save({ school: 'New' })).resolves.toMatchObject({ school: 'Rivet High (saved)' });
    await expect(store.uploadAvatar(new File(['x'], 'me.jpg'))).resolves.toMatchObject({ avatar_url: 'u' });
  });
});
