const subscribe = jest.fn();

jest.mock('./auth-store', () => ({
  authStore: { subscribe: (...args: unknown[]) => subscribe(...args) },
}));

describe('profile-store module wiring', () => {
  it('subscribes to auth state changes when the module loads', () => {
    require('./profile-store');

    expect(subscribe).toHaveBeenCalledTimes(1);
  });

  it('clears the singleton cache when the captured listener fires', async () => {
    const { profileStore } = require('./profile-store');
    const listener = subscribe.mock.calls[0][0] as () => void;
    const getProfile = jest.fn().mockResolvedValue({ school: 'Rivet High' });
    (profileStore as any).client = { getProfile };

    await profileStore.myProfile();
    listener();
    await profileStore.myProfile();

    expect(getProfile).toHaveBeenCalledTimes(2);
  });
});
