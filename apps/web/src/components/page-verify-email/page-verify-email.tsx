import { Component, h, State } from '@stencil/core';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';

@Component({ tag: 'page-verify-email', shadow: true })
export class PageVerifyEmail {
  @State() sent = false;

  private get justVerified(): boolean {
    return new URLSearchParams(window.location.search).get('verified') === '1';
  }

  private resend = async (event: Event) => {
    event.preventDefault();
    await authStore.resendVerification();
    this.sent = true;
  };

  render() {
    if (this.justVerified) {
      return (
        <section>
          <h1>Email verified!</h1>
          <a href="/" onClick={(e) => { e.preventDefault(); navigate('/'); }}>Continue</a>
        </section>
      );
    }
    return (
      <section>
        <h1>Check your email</h1>
        <p>We sent you a verification link. Click it to activate your account.</p>
        {this.sent ? <p>Sent — check your inbox.</p> : <button class="btn-primary" onClick={this.resend}>Resend email</button>}
      </section>
    );
  }
}
