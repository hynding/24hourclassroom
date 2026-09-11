import { Component, Env, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';

@Component({ tag: 'page-login', shadow: true })
export class PageLogin {
  @State() email = '';
  @State() password = '';
  @State() errors: Record<string, string[]> = {};
  @State() busy = false;

  private get googleUrl(): string {
    return `${Env.apiBaseUrl}/auth/google/redirect`;
  }

  /**
   * GoogleOAuthController redirects to {spaOrigin}/login?error=... rather
   * than rendering anything itself, so this page is the only place these
   * can be explained. `deactivated` is new in wave A: the OAuth callback
   * now refuses a deactivated account instead of re-admitting it, and
   * without this branch the user landed on a bare form with no clue why.
   */
  private get errorParam(): string | null {
    return new URLSearchParams(window.location.search).get('error');
  }

  private get oauthFailed(): boolean {
    return this.errorParam === 'oauth';
  }

  private get accountDeactivated(): boolean {
    return this.errorParam === 'deactivated';
  }

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.errors = {};
    try {
      await authStore.login(this.email, this.password);
      const user = authStore.currentUser;
      navigate(user && !user.email_verified_at ? '/verify-email' : '/');
    } catch (e) {
      this.errors = e instanceof ApiError ? (e.errors ?? { email: [e.message] }) : { email: ['Something went wrong.'] };
    } finally {
      this.busy = false;
    }
  };

  private fieldError(field: string) {
    return this.errors[field] ? <p class="error">{this.errors[field][0]}</p> : null;
  }

  render() {
    return (
      <section>
        <h1>Sign in</h1>
        {this.oauthFailed && <p class="error">Google sign-in didn't complete. Please try again.</p>}
        {/*
          Deliberately not "please try again": retrying is guaranteed to
          fail identically, so the only useful next step is contacting
          support.
        */}
        {this.accountDeactivated && (
          <p class="error" data-testid="deactivated-error">
            This account has been deactivated. Contact support if you think that's a mistake.
          </p>
        )}
        <form onSubmit={this.onSubmit}>
          <label>
            Email
            <input type="email" required value={this.email} onInput={(e) => (this.email = (e.target as HTMLInputElement).value)} />
          </label>
          {this.fieldError('email')}
          <label>
            Password
            <input type="password" required value={this.password} onInput={(e) => (this.password = (e.target as HTMLInputElement).value)} />
          </label>
          {this.fieldError('password')}
          <button type="submit" disabled={this.busy}>Sign in</button>
        </form>
        <a href={this.googleUrl}>Continue with Google</a>
        <p>
          <a href="/forgot-password" onClick={(e) => { e.preventDefault(); navigate('/forgot-password'); }}>Forgot password?</a>
          {' · '}
          <a href="/register" onClick={(e) => { e.preventDefault(); navigate('/register'); }}>Create an account</a>
        </p>
      </section>
    );
  }
}
