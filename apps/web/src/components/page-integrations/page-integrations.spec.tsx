import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getIntegrations = jest.fn();
const createMcpToken = jest.fn();
const revokeMcpToken = jest.fn();
const setAnthropicKey = jest.fn();
const removeAnthropicKey = jest.fn();
jest.mock('../../services/generation-store', () => ({
  generationStore: {
    getIntegrations: (...a: unknown[]) => getIntegrations(...a),
    createMcpToken: (...a: unknown[]) => createMcpToken(...a),
    revokeMcpToken: (...a: unknown[]) => revokeMcpToken(...a),
    setAnthropicKey: (...a: unknown[]) => setAnthropicKey(...a),
    removeAnthropicKey: (...a: unknown[]) => removeAnthropicKey(...a),
  },
}));
// The page shows one URL rather than fetching it: the `claude mcp add` line.
jest.mock('../../services/profile-store', () => ({ apiClient: { getBaseUrl: () => 'https://api.test' } }));
// load() is what app-root leaves in flight while the route renders; these
// specs resolve it to `pending` so a component that reads the role without
// awaiting sees no user, exactly as it does in a browser on a hard load.
let currentUser: unknown = null;
let pending: unknown = null;
const authLoad = jest.fn(async () => { currentUser = pending; return currentUser; });
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: () => authLoad() },
}));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageIntegrations } from './page-integrations';

const payload = (extra: Record<string, unknown> = {}) => ({
  mcp_tokens: [],
  anthropic: { configured: false, hint: null, verified_at: null },
  ...extra,
});

const mount = async () => {
  const page = await newSpecPage({ components: [PageIntegrations], html: '<page-integrations></page-integrations>' });
  await page.waitForChanges();
  return page;
};

const clickButton = async (page: Awaited<ReturnType<typeof mount>>, label: string) => {
  const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.trim() === label);
  expect(button).toBeTruthy();
  button.click();
  await page.waitForChanges();
  await page.waitForChanges();
};

describe('page-integrations', () => {
  beforeEach(() => {
    getIntegrations.mockReset().mockResolvedValue(payload());
    createMcpToken.mockReset();
    revokeMcpToken.mockReset().mockResolvedValue(undefined);
    setAnthropicKey.mockReset();
    removeAnthropicKey.mockReset().mockResolvedValue(undefined);
    authLoad.mockClear();
    currentUser = null;
    pending = { id: 1, role: 'teacher' };
  });

  it('renders the token list and the unconfigured key state for a teacher', async () => {
    getIntegrations.mockResolvedValue(payload({
      mcp_tokens: [
        { id: 1, name: 'Claude Code', last_used_at: '2026-09-20T10:00:00Z', created_at: '2026-09-01T00:00:00Z' },
        { id: 2, name: 'Laptop', last_used_at: null, created_at: '2026-09-02T00:00:00Z' },
      ],
    }));
    const page = await mount();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Claude connection');
    expect(text).toContain('Anthropic API key');
    expect(text).toContain('Claude Code');
    expect(text).toContain('Laptop');
    // A token that has never been used says so rather than showing a blank.
    expect(text).toContain('never');
    expect(text).toContain('Not configured');
    expect(authLoad).toHaveBeenCalled();
  });

  it('shows an empty state for every other role and for a signed-out visitor', async () => {
    // Allowlist: a fourth role must be invalid by default.
    for (const role of ['student', 'admin', null]) {
      pending = role === null ? null : { id: 1, role };
      const page = await mount();
      expect(page.root.shadowRoot.textContent).toContain('Integrations are for teachers.');
      expect(getIntegrations).not.toHaveBeenCalled();
    }
  });

  it('shows the one-time panel with the token and the claude mcp add line after create', async () => {
    createMcpToken.mockResolvedValue({ id: 3, name: 'Laptop', token: '3|plaintext-secret' });
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.tokenName = 'Laptop';

    await cmp.createToken();
    await page.waitForChanges();
    const root = page.root.shadowRoot;

    expect(createMcpToken).toHaveBeenCalledWith('Laptop');
    expect(root.textContent).toContain('This token is shown only once.');
    expect((root.querySelector('[data-testid="new-token"]') as HTMLInputElement).value).toBe('3|plaintext-secret');
    const command = root.querySelector('[data-testid="mcp-command"]')!.textContent;
    expect(command).toBe(
      'claude mcp add --transport http 24hourclassroom https://api.test/mcp/teacher --header "Authorization: Bearer 3|plaintext-secret"',
    );
    // The new token also joins the list.
    expect(root.textContent).toContain('Laptop');
  });

  it('copies the token when the browser has a clipboard', async () => {
    createMcpToken.mockResolvedValue({ id: 3, name: 'Laptop', token: '3|plaintext-secret' });
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.tokenName = 'Laptop';
    await cmp.createToken();
    await page.waitForChanges();
    // Stubbed AFTER mount, like window.confirm: newSpecPage resets the mock
    // window and mock-doc has no clipboard of its own.
    const writeText = jest.fn().mockResolvedValue(undefined);
    Object.defineProperty(navigator, 'clipboard', { value: { writeText }, configurable: true });

    await clickButton(page, 'Copy');

    expect(writeText).toHaveBeenCalledWith('3|plaintext-secret');
    expect(cmp.copied).toBe(true);
  });

  it('does not throw when there is no clipboard, and leaves the token selectable', async () => {
    createMcpToken.mockResolvedValue({ id: 3, name: 'Laptop', token: '3|plaintext-secret' });
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.tokenName = 'Laptop';
    await cmp.createToken();
    await page.waitForChanges();
    Object.defineProperty(navigator, 'clipboard', { value: undefined, configurable: true });

    await expect(cmp.copyToken()).resolves.toBeUndefined();
    await page.waitForChanges();

    expect(cmp.copied).toBe(false);
    // The fallback: the plaintext is still on screen to select by hand.
    expect((page.root.shadowRoot.querySelector('[data-testid="new-token"]') as HTMLInputElement).value).toBe('3|plaintext-secret');
  });

  it('removes the row when a token is revoked', async () => {
    getIntegrations.mockResolvedValue(payload({
      mcp_tokens: [{ id: 1, name: 'Claude Code', last_used_at: null, created_at: '2026-09-01T00:00:00Z' }],
    }));
    const page = await mount();

    await clickButton(page, 'Revoke');

    expect(revokeMcpToken).toHaveBeenCalledWith(1);
    expect(page.root.shadowRoot.textContent).not.toContain('Claude Code');
  });

  it('disables Create at five tokens and says what to do', async () => {
    getIntegrations.mockResolvedValue(payload({
      mcp_tokens: [1, 2, 3, 4, 5].map((id) => ({ id, name: `Token ${id}`, last_used_at: null, created_at: '2026-09-01T00:00:00Z' })),
    }));
    const page = await mount();
    const create = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.trim() === 'Create');

    // hasAttribute, not `.disabled`: mock-doc's button element does not patch
    // a `disabled` property, so the attribute is the only reliable read.
    expect(create.hasAttribute('disabled')).toBe(true);
    expect(page.root.shadowRoot.textContent).toContain('Revoke a token first.');
  });

  it('renders the server message when creating a token is rejected', async () => {
    createMcpToken.mockRejectedValue(new ApiError(422, 'The given data was invalid.', { name: ['Revoke a token first.'] }));
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.tokenName = 'Sixth';

    await cmp.createToken();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('Revoke a token first.');
    expect(page.root.shadowRoot.querySelector('[data-testid="new-token"]')).toBeNull();
  });

  it('saves a key and shows it configured with the hint', async () => {
    setAnthropicKey.mockResolvedValue({ configured: true, hint: '6789', verified_at: '2026-09-21T00:00:00Z' });
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.apiKey = 'sk-ant-0123456789abcdef6789';

    await cmp.saveKey();
    await page.waitForChanges();

    expect(setAnthropicKey).toHaveBeenCalledWith('sk-ant-0123456789abcdef6789');
    expect(page.root.shadowRoot.textContent).toContain('Configured ····6789');
    // The submit button changes meaning once a key exists.
    expect(page.root.shadowRoot.textContent).toContain('Replace');
    // Never held after the round trip.
    expect(cmp.apiKey).toBe('');
  });

  it('renders a 422 on the key under the input', async () => {
    setAnthropicKey.mockRejectedValue(new ApiError(422, 'The given data was invalid.', { api_key: ['Anthropic rejected that API key.'] }));
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.apiKey = 'sk-ant-wrong-but-long-enough';

    await cmp.saveKey();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('Anthropic rejected that API key.');
    expect(page.root.shadowRoot.textContent).toContain('Not configured');
  });

  it('renders the server sentence when Anthropic cannot be reached', async () => {
    setAnthropicKey.mockRejectedValue(new ApiError(503, 'Anthropic could not be reached. Try again in a moment.'));
    const page = await mount();
    const cmp = page.rootInstance as PageIntegrations;
    cmp.apiKey = 'sk-ant-0123456789abcdef6789';

    await cmp.saveKey();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('Anthropic could not be reached. Try again in a moment.');
  });

  it('removes the key after the confirm dialog, naming what is cancelled', async () => {
    getIntegrations.mockResolvedValue(payload({ anthropic: { configured: true, hint: '6789', verified_at: '2026-09-21T00:00:00Z' } }));
    const page = await mount();
    // newSpecPage resets the mock window, so the stub only lands after mount --
    // which is exactly why the component calls `window.confirm`, not `confirm`.
    const confirm = jest.fn().mockReturnValue(true);
    window.confirm = confirm;

    await clickButton(page, 'Remove');

    expect(confirm).toHaveBeenCalledWith('Remove your Anthropic API key? Any running generations are cancelled.');
    expect(removeAnthropicKey).toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('Not configured');
  });

  it('does not remove the key when the dialog is cancelled', async () => {
    getIntegrations.mockResolvedValue(payload({ anthropic: { configured: true, hint: '6789', verified_at: null } }));
    const page = await mount();
    window.confirm = () => false;

    await clickButton(page, 'Remove');

    expect(removeAnthropicKey).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('Configured ····6789');
  });
});
