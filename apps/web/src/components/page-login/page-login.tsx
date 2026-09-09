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

  private get oauthFailed(): boolean {
    return new URLSearchParams(window.location.search).get('error') === 'oauth';
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
