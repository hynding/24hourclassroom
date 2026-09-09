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
