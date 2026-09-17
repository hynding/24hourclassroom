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

  it('load shares one request between concurrent callers', async () => {
    const client = clientMock();
    let release: (u: unknown) => void;
    client.currentUser.mockImplementation(() => new Promise((r) => { release = r; }));
    const store = new AuthStore(client as any);

    // app-root starts the load and does not await it before the route renders;
    // the page then awaits the same load. One /api/user, not two.
    const first = store.load();
    const second = store.load();
    release(user);

    expect(await first).toEqual(user);
    expect(await second).toEqual(user);
    expect(client.currentUser).toHaveBeenCalledTimes(1);
  });

  it('load can be retried after the request fails', async () => {
    const client = clientMock();
    client.currentUser.mockRejectedValueOnce(new Error('offline'));
    const store = new AuthStore(client as any);

    await expect(store.load()).rejects.toThrow('offline');
    expect(await store.load()).toEqual(user);
    expect(client.currentUser).toHaveBeenCalledTimes(2);
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

  it('sessionExpired clears the user and notifies subscribers', async () => {
    const client = clientMock();
    const store = new AuthStore(client as any);
    await store.load();
    const seen: unknown[] = [];
    store.subscribe((u) => seen.push(u));

    store.sessionExpired();

    expect(store.currentUser).toBeNull();
    expect(seen).toEqual([null]);
    // The server already rejected the session; re-asking it would be a
    // wasted round trip that can only return null.
    expect(client.currentUser).toHaveBeenCalledTimes(1);
  });
});
