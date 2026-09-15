import { describe, expect, it, vi } from 'vitest';
import { ApiClient, ApiError } from '../src/index';

const jsonResponse = (status: number, body: unknown) =>
  status === 204
    ? new Response(null, { status })
    : new Response(JSON.stringify(body), { status, headers: { 'Content-Type': 'application/json' } });

describe('ApiClient', () => {
  it('GETs JSON with credentials included', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { ok: true }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    const result = await client.get<{ ok: boolean }>('/api/ping');

    expect(result).toEqual({ ok: true });
    expect(fetchFn).toHaveBeenCalledWith(
      'https://api.test/api/ping',
      expect.objectContaining({ method: 'GET', credentials: 'include' }),
    );
  });

  it('fetches the CSRF cookie exactly once before the first POST', async () => {
    const fetchFn = vi
      .fn()
      .mockImplementation(() => jsonResponse(200, {}));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.post('/api/a', { x: 1 });
    await client.post('/api/b', { x: 2 });

    const urls = fetchFn.mock.calls.map((c) => c[0]);
    expect(urls.filter((u) => u === 'https://api.test/sanctum/csrf-cookie')).toHaveLength(1);
    expect(urls[0]).toBe('https://api.test/sanctum/csrf-cookie');
  });

  it('throws ApiError with the status on failure', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(422, { message: 'nope' }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await expect(client.get('/api/thing')).rejects.toSatisfy(
      (e: unknown) => e instanceof ApiError && e.status === 422,
    );
  });

  it('currentUser returns null on 401 and the user on 200', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(401, { message: 'unauthenticated' }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });
    expect(await client.currentUser()).toBeNull();

    const user = { id: 1, name: 'T', email: 't@example.com', email_verified_at: null };
    const fetchFn2 = vi.fn().mockResolvedValue(jsonResponse(200, user));
    const client2 = new ApiClient({ baseUrl: 'https://api.test', fetchFn: fetchFn2 });
    expect(await client2.currentUser()).toEqual(user);
  });
});

describe('ApiError bodies', () => {
  it('exposes message and field errors from a 422 body', async () => {
    const body = { message: 'The given data was invalid.', errors: { email: ['Taken.'] } };
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(422, body));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    const err = await client.get('/api/x').catch((e) => e);
    expect(err).toBeInstanceOf(ApiError);
    expect(err.message).toBe('The given data was invalid.');
    expect(err.errors).toEqual({ email: ['Taken.'] });
  });
});

describe('auth methods', () => {
  const okFetch = () => vi.fn().mockImplementation(() => jsonResponse(204, null));

  it.each([
    ['register', (c: ApiClient) => c.register({ name: 'A', email: 'a@b.c', password: 'p', password_confirmation: 'p', role: 'teacher' }), '/api/auth/register'],
    ['login', (c: ApiClient) => c.login({ email: 'a@b.c', password: 'p' }), '/api/auth/login'],
    ['logout', (c: ApiClient) => c.logout(), '/api/auth/logout'],
    ['resetPassword', (c: ApiClient) => c.resetPassword({ token: 't', email: 'a@b.c', password: 'p', password_confirmation: 'p' }), '/api/auth/reset-password'],
    ['resendVerification', (c: ApiClient) => c.resendVerification(), '/api/auth/verification-notification'],
    ['completeOauth', (c: ApiClient) => c.completeOauth('student'), '/api/auth/oauth/complete'],
  ])('%s POSTs the right path', async (_name, call, path) => {
    const fetchFn = okFetch();
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await call(client);

    const urls = fetchFn.mock.calls.map((c) => c[0]);
    expect(urls).toContain(`https://api.test${path}`);
  });

  it('forgotPassword returns the message payload', async () => {
    const fetchFn = vi.fn().mockImplementation((url: string) =>
      url.endsWith('/sanctum/csrf-cookie') ? jsonResponse(204, null) : jsonResponse(200, { message: 'Sent.' }),
    );
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    expect(await client.forgotPassword('a@b.c')).toEqual({ message: 'Sent.' });
  });
});

describe('ApiClient profile methods', () => {
  it('fetches the CSRF cookie before a PUT', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(200, {}));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.put('/api/profile', { school: 'Rivet High' });

    const urls = fetchFn.mock.calls.map((c) => c[0]);
    expect(urls[0]).toBe('https://api.test/sanctum/csrf-cookie');
    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/profile',
      expect.objectContaining({ method: 'PUT' }),
    );
  });

  it('fetches the CSRF cookie before a DELETE', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.deleteAvatar();

    const urls = fetchFn.mock.calls.map((c) => c[0]);
    expect(urls[0]).toBe('https://api.test/sanctum/csrf-cookie');
    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/profile/avatar',
      expect.objectContaining({ method: 'DELETE' }),
    );
  });

  it('sends an avatar as FormData without a Content-Type header', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(200, { avatar_url: 'u' }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });
    const file = new File(['x'], 'me.jpg', { type: 'image/jpeg' });

    await client.uploadAvatar(file);

    const init = fetchFn.mock.calls.at(-1)![1];
    expect(init.body).toBeInstanceOf(FormData);
    expect((init.body as FormData).get('avatar')).toBe(file);
    expect(init.headers).not.toHaveProperty('Content-Type');
  });

  it('builds the teacher directory query string from filters', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { data: [], meta: {} }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.getTeachers({ subject: 'math', grade: '9-12', q: 'hopper', page: 2 });

    expect(fetchFn.mock.calls[0][0]).toBe(
      'https://api.test/api/teachers?subject=math&grade=9-12&q=hopper&page=2',
    );
  });

  it('omits absent filters entirely', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { data: [], meta: {} }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.getTeachers();

    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/teachers');
  });

  it('omits an explicitly empty search string rather than sending q=', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { data: [], meta: {} }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.getTeachers({ q: '' });

    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/teachers');
  });

  it('includes a provided page value', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { data: [], meta: {} }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.getTeachers({ page: 3 });

    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/teachers?page=3');
  });

  it('sends page: 0 rather than dropping it as falsy', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { data: [], meta: {} }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.getTeachers({ page: 0 });

    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/teachers?page=0');
  });

  it('fetches a public profile by id', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { id: 7, name: 'Ada' }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    const profile = await client.getPublicProfile(7);

    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/users/7');
    expect(profile.name).toBe('Ada');
  });
});

describe('ApiClient connection and notification methods', () => {
  it('fetches the CSRF cookie before a PATCH', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.acceptConnection(7);

    const urls = fetchFn.mock.calls.map((c) => c[0]);
    expect(urls[0]).toBe('https://api.test/sanctum/csrf-cookie');
    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/connections/7',
      expect.objectContaining({ method: 'PATCH' }),
    );
  });

  it('follows and unfollows by user id on the same path', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.followTeacher(3);
    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/users/3/follow',
      expect.objectContaining({ method: 'POST' }),
    );

    await client.unfollowTeacher(3);
    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/users/3/follow',
      expect.objectContaining({ method: 'DELETE' }),
    );
  });

  it('requests a connection by target user id, not connection id', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.requestConnection(9);

    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/connections/9',
      expect.objectContaining({ method: 'POST' }),
    );
  });

  it('removes a connection by connection id, not user id', async () => {
    // These two take different id spaces and the URLs look alike; a swap
    // would delete the wrong row.
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.removeConnection(42);

    expect(fetchFn).toHaveBeenLastCalledWith(
      'https://api.test/api/connections/42',
      expect.objectContaining({ method: 'DELETE' }),
    );
  });

  it('marks all notifications read when given no ids', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.markNotificationsRead();

    const init = fetchFn.mock.calls.at(-1)![1];
    expect(JSON.parse(init.body as string)).toEqual({});
  });

  it('marks only the given notifications read when ids are supplied', async () => {
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(204, null));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.markNotificationsRead(['a', 'b']);

    const init = fetchFn.mock.calls.at(-1)![1];
    expect(JSON.parse(init.body as string)).toEqual({ ids: ['a', 'b'] });
  });

  it('omits the page param on page 1 and sends it beyond', async () => {
    // mockResolvedValue would hand back the same single-use Response object
    // to both calls below; mockImplementation gives each call a fresh one.
    const fetchFn = vi.fn().mockImplementation(() => jsonResponse(200, { data: [], meta: {} }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.getNotifications();
    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/notifications');

    await client.getNotifications(3);
    expect(fetchFn.mock.calls.at(-1)![0]).toBe('https://api.test/api/notifications?page=3');
  });

  it('reads the unread count', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { count: 4 }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    expect(await client.getUnreadCount()).toBe(4);
    expect(fetchFn.mock.calls[0][0]).toBe('https://api.test/api/notifications/unread-count');
  });

  it('getSite GETs /api/site and returns the typed theme', async () => {
    const fetchFn = vi.fn().mockResolvedValue(
      jsonResponse(200, { theme: { layout: 'rail', palette: 'evening', typeset: 'modern' } }),
    );
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    const site = await client.getSite();

    expect(fetchFn).toHaveBeenCalledWith('https://api.test/api/site', expect.objectContaining({ method: 'GET' }));
    // Distinguishable from the defaults, so this only passes if the response
    // is returned rather than a hard-coded theme.
    expect(site).toEqual({ theme: { layout: 'rail', palette: 'evening', typeset: 'modern' } });
  });
});
