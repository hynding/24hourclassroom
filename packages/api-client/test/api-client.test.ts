import { describe, expect, it, vi } from 'vitest';
import { ApiClient, ApiError } from '../src/index';

const jsonResponse = (status: number, body: unknown) =>
  new Response(JSON.stringify(body), {
    status,
    headers: { 'Content-Type': 'application/json' },
  });

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
