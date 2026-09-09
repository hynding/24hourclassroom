import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { authStore } from '../../services/auth-store';

@Component({ tag: 'page-forgot-password', shadow: true })
export class PageForgotPassword {
  @State() email = '';
  @State() message = '';
  @State() error = '';
  @State() busy = false;

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.error = '';
    try {
      const result = await authStore.forgotPassword(this.email);
      this.message = result.message;
    } catch (e) {
      this.error = e instanceof ApiError ? e.message : 'Something went wrong.';
    } finally {
      this.busy = false;
    }
  };

  render() {
    return (
      <section>
        <h1>Reset your password</h1>
        {this.message ? (
          <p>{this.message}</p>
        ) : (
          <form onSubmit={this.onSubmit}>
            {this.error && <p class="error">{this.error}</p>}
            <label>
              Email
              <input type="email" required value={this.email} onInput={(e) => (this.email = (e.target as HTMLInputElement).value)} />
            </label>
            <button type="submit" disabled={this.busy}>Send reset link</button>
          </form>
        )}
      </section>
    );
  }
}
