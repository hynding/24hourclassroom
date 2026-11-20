import { Component, h, Listen, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { REGISTRATION_ROLES, roleLabel } from '@24hc/shared';
import type { RegistrationRole, SiteConfig } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';
import { BirthAnswer, birthFields, isAgeBlocked, isUnderAgeRefusal, markAgeBlocked, renderBirthFields, screensAge, UNDER_AGE_NOTICE } from '../../services/age-screen';

@Component({ tag: 'page-register-role', styleUrl: 'page-register-role.css', shadow: true })
export class PageRegisterRole {
  @State() role: RegistrationRole = 'teacher';
  @State() error = '';
  @State() busy = false;
  @State() site: SiteConfig = siteStore.config;
  @State() closed: string | null = null;
  @State() birth: BirthAnswer = { month: null, year: null };
  @State() ageBlocked = isAgeBlocked();

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.error = '';
    try {
      await authStore.completeOauth(this.role, birthFields(this.role, this.birth));
      navigate('/');
    } catch (e) {
      if (e instanceof ApiError && e.status === 403) {
        // Registration closed between the page load and the submit.
        this.closed = e.message;
        return;
      }
      if (e instanceof ApiError && isUnderAgeRefusal(e.errors)) {
        markAgeBlocked();
        this.ageBlocked = true;
        return;
      }
      this.error = e instanceof ApiError ? (e.errors?.birth_year?.[0] ?? e.message) : 'Something went wrong.';
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
    if (this.ageBlocked) {
      return (
        <section>
          <h1>One last step</h1>
          <p class="notice">{UNDER_AGE_NOTICE}</p>
        </section>
      );
    }
    return (
      <section>
        <h1>One last step</h1>
        <p>Tell us who you are to finish creating your account.</p>
        {this.error && <p class="error">{this.error}</p>}
        <form onSubmit={this.onSubmit}>
          {REGISTRATION_ROLES.map((role) => (
            <label>
              <input type="radio" name="role" value={role} checked={this.role === role} onInput={() => (this.role = role)} />
              {roleLabel(role)}
            </label>
          ))}
          {screensAge(this.role) && renderBirthFields(this.birth, (next) => (this.birth = next))}
          <button type="submit" class="btn-primary" disabled={this.busy}>Finish</button>
        </form>
      </section>
    );
  }
}
