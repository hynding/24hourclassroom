import { Component, h, Listen, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import type { RegistrationRole, SiteConfig } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';

@Component({ tag: 'page-register-role', styleUrl: 'page-register-role.css', shadow: true })
export class PageRegisterRole {
  @State() role: RegistrationRole = 'teacher';
  @State() error = '';
  @State() busy = false;
  @State() site: SiteConfig = siteStore.config;
  @State() closed: string | null = null;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.error = '';
    try {
      await authStore.completeOauth(this.role);
      navigate('/');
    } catch (e) {
      if (e instanceof ApiError && e.status === 403) {
        // Registration closed between the page load and the submit.
        this.closed = e.message;
        return;
      }
      this.error = e instanceof ApiError ? e.message : 'Something went wrong.';
    } finally {
      this.busy = false;
    }
  };

  render() {
    if (this.closed !== null || !this.site.registration.open) {
      return (
        <section>
          <h1>One last step</h1>
          <p class="notice">{this.closed ?? this.site.registration.message ?? 'Registration is closed.'}</p>
        </section>
      );
    }
    return (
      <section>
        <h1>One last step</h1>
        <p>Tell us who you are to finish creating your account.</p>
        {this.error && <p class="error">{this.error}</p>}
        <form onSubmit={this.onSubmit}>
          <label>
            <input type="radio" name="role" checked={this.role === 'teacher'} onInput={() => (this.role = 'teacher')} />
            Teacher
          </label>
          <label>
            <input type="radio" name="role" checked={this.role === 'student'} onInput={() => (this.role = 'student')} />
            Student
          </label>
          <button type="submit" class="btn-primary" disabled={this.busy}>Finish</button>
        </form>
      </section>
    );
  }
}
