import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';

@Component({ tag: 'page-reset-password', styleUrl: 'page-reset-password.css', shadow: true })
export class PageResetPassword {
  @State() password = '';
  @State() passwordConfirmation = '';
  @State() errors: Record<string, string[]> = {};
  @State() busy = false;

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    const params = new URLSearchParams(window.location.search);
    this.busy = true;
    this.errors = {};
    try {
      await authStore.resetPassword({
        token: params.get('token') ?? '',
        email: params.get('email') ?? '',
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      });
      navigate('/login');
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
        <h1>Choose a new password</h1>
        <form onSubmit={this.onSubmit}>
          {this.fieldError('email')}
          {this.fieldError('token')}
          <label>
            New password
            <input type="password" required value={this.password} onInput={(e) => (this.password = (e.target as HTMLInputElement).value)} />
          </label>
          {this.fieldError('password')}
          <label>
            Confirm password
            <input type="password" required value={this.passwordConfirmation} onInput={(e) => (this.passwordConfirmation = (e.target as HTMLInputElement).value)} />
          </label>
          <button type="submit" class="btn-primary" disabled={this.busy}>Reset password</button>
        </form>
      </section>
    );
  }
}
