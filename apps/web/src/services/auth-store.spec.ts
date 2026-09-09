import { AuthStore } from './auth-store';

const user = { id: 1, name: 'T', email: 't@e.c', email_verified_at: null, role: 'teacher' } as any;

const clientMock = () => ({
  currentUser: jest.fn().mockResolvedValue(user),
  login: jest.fn().mockResolvedValue(undefined),
  logout: jest.fn().mockResolvedValue(undefined),
  register: jest.fn().mockResolvedValue(undefined),
  completeOauth: jest.fn().mockResolvedValue(undefined),
});

describe('auth-store', () => {
  it('load caches the current user and notifies subscribers', async () => {
    const client = clientMock();
    const store = new AuthStore(client as any);
    const seen: unknown[] = [];
    store.subscribe((u) => seen.push(u));

    await store.load();
    await store.load();

    expect(client.currentUser).toHaveBeenCalledTimes(1);
    expect(store.currentUser).toEqual(user);
    expect(seen).toEqual([user]);
  });

  it('login refreshes the user; logout clears it', async () => {
    const client = clientMock();
    const store = new AuthStore(client as any);

    await store.login('t@e.c', 'pw');
    expect(client.login).toHaveBeenCalledWith({ email: 't@e.c', password: 'pw' });
    expect(store.currentUser).toEqual(user);

    await store.logout();
    expect(store.currentUser).toBeNull();
  });
});
