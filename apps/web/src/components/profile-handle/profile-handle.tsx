import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { HandleState, PUBLIC_ROLES, hasRole } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { slugStore } from '../../services/slug-store';

/**
 * A teacher's (or tutor's) handle: /teachers/<handle>, admin-approved
 * (App\Support\Slugs). Only a Role::isPublic() role has a public page to
 * name, so anyone else sees nothing. Lives on page-profile.
 */
@Component({ tag: 'profile-handle', styleUrl: 'profile-handle.css', shadow: true })
export class ProfileHandle {
  @State() state: HandleState | null = null;
  @State() value = '';
  @State() error = '';
  @State() busy = false;
  @State() eligible = false;

  async componentWillLoad() {
    const user = await authStore.load().catch(() => null);
    this.eligible = hasRole(PUBLIC_ROLES, user?.role);
    if (!this.eligible) {
      return;
    }
    try {
      this.apply(await slugStore.getHandle());
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load your handle.';
      }
    }
  }

  private apply(state: HandleState) {
    this.state = state;
    this.value = state.request?.status === 'pending' ? state.request.slug : state.handle ?? '';
  }

  private async submit(handle: string | null) {
    this.busy = true;
    this.error = '';
    try {
      this.apply(await slugStore.requestHandle(handle));
    } catch (e) {
      if (e instanceof ApiError) {
        this.error = e.errors?.handle?.[0] ?? e.message;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = 'Something went wrong.';
      }
    } finally {
      this.busy = false;
    }
  }

  render() {
    if (!this.eligible) {
      return null;
    }
    const request = this.state?.request ?? null;
    const pending = request?.status === 'pending';
    return (
      <form onSubmit={(e) => { e.preventDefault(); this.submit(this.value.trim() || null); }}>
        <h2>Your address</h2>
        {this.state?.handle
          ? <p>Your page is at <a href={this.state.path} onClick={(e) => { e.preventDefault(); navigate(this.state!.path); }}><code>{this.state.path}</code></a>.</p>
          : <p>Ask for a handle to give your page and courses a readable address. An admin reviews each handle; after that, the course addresses you choose go live straight away.</p>}
        <label>
          Handle
          <span class="slug-input">
            <span class="prefix">/teachers/</span>
            <input type="text" maxlength="60" pattern="[a-z0-9]+(-[a-z0-9]+)*" placeholder="ms-rivera" value={this.value} onInput={(e) => (this.value = (e.target as HTMLInputElement).value.toLowerCase())} />
          </span>
        </label>
        {this.error && <p class="error">{this.error}</p>}
        {pending && <p class="notice" role="status">/teachers/{request!.slug} is waiting for approval.</p>}
        {request?.status === 'rejected' && <p class="notice" role="status">/teachers/{request.slug} was declined. Try another handle.</p>}
        <div class="actions">
          <button type="submit" class="btn" disabled={this.busy || this.value.trim() === '' || this.value.trim() === (pending ? request!.slug : this.state?.handle ?? '')}>
            {this.state?.handle ? 'Ask to change' : 'Ask for this handle'}
          </button>
          {pending && <button type="button" class="btn" disabled={this.busy} onClick={() => this.submit(null)}>Withdraw request</button>}
        </div>
      </form>
    );
  }
}
