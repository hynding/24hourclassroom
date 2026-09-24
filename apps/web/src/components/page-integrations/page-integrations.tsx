import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import type { AnthropicIntegration, McpToken, McpTokenCreated } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { generationStore } from '../../services/generation-store';
import { apiClient } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';

/**
 * The server's own cap (McpTokenController answers a sixth with a 422 on
 * `name`). Mirrored here only to disable the button before the round trip --
 * the 422 is still rendered if the two ever disagree.
 */
const MAX_TOKENS = 5;

@Component({ tag: 'page-integrations', styleUrl: 'page-integrations.css', shadow: true })
export class PageIntegrations {
  @State() tokens: McpToken[] = [];
  @State() anthropic: AnthropicIntegration = { configured: false, hint: null, verified_at: null };
  @State() loaded = false;
  @State() loadError = false;
  @State() tokenName = '';
  /** The plaintext, held only for this render. Never persisted anywhere. */
  @State() created: McpTokenCreated | null = null;
  @State() copied = false;
  @State() tokenError = '';
  @State() apiKey = '';
  @State() keyError = '';
  @State() keyMessage = '';
  @State() busy = false;

  /** Allowlist: anything that is not exactly teacher gets the empty state. */
  private get role(): 'teacher' | 'none' {
    return authStore.currentUser?.role === 'teacher' ? 'teacher' : 'none';
  }

  async componentWillLoad() {
    // app-root renders the routed page before authStore.load() resolves, and
    // `role` is a plain getter, so reading it first would latch the empty
    // state on every hard load of /integrations and never recover.
    await authStore.load();
    if (this.role !== 'teacher') {
      return;
    }
    await this.load();
  }

  private async load() {
    try {
      const payload = await generationStore.getIntegrations();
      this.tokens = payload.mcp_tokens;
      this.anthropic = payload.anthropic;
      this.loaded = true;
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.loadError = true;
      }
    }
  }

  async createToken() {
    this.tokenError = '';
    this.copied = false;
    this.busy = true;
    try {
      const created = await generationStore.createMcpToken(this.tokenName);
      this.created = created;
      // Prepend rather than re-fetch: the list is newest-first server-side
      // and a second GET would spend another request from the shared bucket.
      this.tokens = [
        { id: created.id, name: created.name, last_used_at: null, created_at: new Date().toISOString() },
        ...this.tokens,
      ];
      this.tokenName = '';
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.tokenError = e instanceof ApiError && e.errors?.name
          ? e.errors.name[0]
          : 'We could not create that token. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  async revokeToken(id: number) {
    this.tokenError = '';
    this.busy = true;
    try {
      await generationStore.revokeMcpToken(id);
      this.tokens = this.tokens.filter((t) => t.id !== id);
      if (this.created !== null && this.created.id === id) {
        this.created = null;
      }
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.tokenError = 'We could not revoke that token. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  /**
   * Public so the spec can call it directly. The optional call and the catch
   * are both real paths: mock-doc has no clipboard, and neither does a page
   * served over plain http. `copied` is only claimed when there was a
   * clipboard to write to -- the readonly input is the fallback either way.
   */
  async copyToken(): Promise<void> {
    if (this.created === null) {
      return;
    }
    try {
      await navigator.clipboard?.writeText(this.created.token);
      this.copied = navigator.clipboard != null;
    } catch {
      this.copied = false;
    }
  }

  async saveKey() {
    this.keyError = '';
    this.keyMessage = '';
    this.busy = true;
    try {
      this.anthropic = await generationStore.setAnthropicKey(this.apiKey);
      this.apiKey = '';
      this.keyMessage = 'Key saved.';
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      if (e instanceof ApiError && e.status === 422) {
        this.keyError = e.errors?.api_key?.[0] ?? 'That key was not accepted.';
      } else if (e instanceof ApiError && e.status === 503) {
        // The server could not reach Anthropic to verify the key. Its own
        // sentence is the useful one -- nothing is wrong with the input.
        this.keyError = e.message;
      } else {
        this.keyError = 'We could not save that key. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  removeKey() {
    // Ask BEFORE the request, and through `window.confirm` rather than the
    // bare global -- newSpecPage resets the mock window, so a spec can only
    // stub the property after mount. The wording names the consequence: the
    // DELETE cancels every live generation and archives the agent.
    if (!window.confirm('Remove your Anthropic API key? Any running generations are cancelled.')) {
      return undefined;
    }
    return this.runRemoveKey();
  }

  private async runRemoveKey() {
    this.keyError = '';
    this.keyMessage = '';
    this.busy = true;
    try {
      await generationStore.removeAnthropicKey();
      this.anthropic = { configured: false, hint: null, verified_at: null };
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.keyError = 'We could not remove that key. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  private mcpCommand(token: string): string {
    return `claude mcp add --transport http 24hourclassroom ${apiClient.getBaseUrl()}/mcp/teacher --header "Authorization: Bearer ${token}"`;
  }

  private lastUsed(token: McpToken): string {
    return token.last_used_at === null ? 'never' : new Date(token.last_used_at).toLocaleDateString();
  }

  private verifiedOn(): string {
    return this.anthropic.verified_at === null
      ? ''
      : ` · verified ${new Date(this.anthropic.verified_at).toLocaleDateString()}`;
  }

  render() {
    if (this.role !== 'teacher') {
      return (
        <section>
          <h1>Integrations</h1>
          <p>Integrations are for teachers.</p>
        </section>
      );
    }
    if (this.loadError) {
      return (
        <section>
          <h1>Integrations</h1>
          <p>We could not load your integrations. Please try again.</p>
        </section>
      );
    }
    const atCap = this.tokens.length >= MAX_TOKENS;
    return (
      <section>
        <h1>Integrations</h1>

        <div class="card">
          <h2>Claude connection</h2>
          <p class="hint">
            Connect your own Claude client to read your materials and write test drafts into your account.
          </p>
          {this.tokenError && <p class="error">{this.tokenError}</p>}
          {this.loaded && this.tokens.length === 0 && <p>No tokens yet.</p>}
          <ul class="rows">
            {this.tokens.map((t) => (
              <li>
                <span class="name">{t.name}</span>
                <span class="meta">last used {this.lastUsed(t)}</span>
                <button type="button" class="btn" disabled={this.busy} onClick={() => this.revokeToken(t.id)}>Revoke</button>
              </li>
            ))}
          </ul>

          {this.created !== null && (
            <div class="token-panel">
              <p>This token is shown only once.</p>
              <input type="text" data-testid="new-token" readOnly value={this.created.token} />
              <button type="button" class="btn" onClick={() => this.copyToken()}>Copy</button>
              {this.copied && <p class="success">Copied.</p>}
              <p class="hint">Add it to Claude Code with:</p>
              <code data-testid="mcp-command">{this.mcpCommand(this.created.token)}</code>
            </div>
          )}

          <form onSubmit={(e) => { e.preventDefault(); this.createToken(); }}>
            <label>
              Token name
              <input
                type="text"
                value={this.tokenName}
                onInput={(e) => (this.tokenName = (e.target as HTMLInputElement).value)}
                required
              />
            </label>
            <div class="actions">
              <button type="submit" class="btn-primary" disabled={this.busy || atCap}>Create</button>
              {atCap && <span class="hint">Revoke a token first.</span>}
            </div>
          </form>
        </div>

        <div class="card">
          <h2>Anthropic API key</h2>
          <p class="hint">
            Generation runs in your own Anthropic organisation, on your key, billed to you.
          </p>
          <p data-testid="key-state">
            {this.anthropic.configured ? `Configured ····${this.anthropic.hint}${this.verifiedOn()}` : 'Not configured'}
          </p>
          {this.keyError && <p class="error">{this.keyError}</p>}
          {this.keyMessage && <p class="success">{this.keyMessage}</p>}
          <form onSubmit={(e) => { e.preventDefault(); this.saveKey(); }}>
            <label>
              API key
              <input
                type="password"
                value={this.apiKey}
                onInput={(e) => (this.apiKey = (e.target as HTMLInputElement).value)}
                required
              />
            </label>
            <div class="actions">
              <button type="submit" class="btn-primary" disabled={this.busy}>
                {this.anthropic.configured ? 'Replace' : 'Save'}
              </button>
              {this.anthropic.configured && (
                <button type="button" class="btn" disabled={this.busy} onClick={() => this.removeKey()}>Remove</button>
              )}
            </div>
          </form>
        </div>
      </section>
    );
  }
}
