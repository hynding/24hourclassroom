import { Component, h, Listen, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { REGISTRATION_ROLES, roleLabel } from '@24hc/shared';
import type { RegistrationRole, SiteConfig } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';
import { BirthAnswer, birthFields, isAgeBlocked, isUnderAgeRefusal, markAgeBlocked, renderBirthFields, screensAge, UNDER_AGE_NOTICE } from '../../services/age-screen';

@Component({ tag: 'page-register', styleUrl: 'page-register.css', shadow: true })
export class PageRegister {
  @State() name = '';
  @State() email = '';
  @State() password = '';
  @State() passwordConfirmation = '';
  @State() role: RegistrationRole = 'teacher';
  @State() errors: Record<string, string[]> = {};
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
    this.errors = {};
    try {
      await authStore.register({
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
        role: this.role,
        ...birthFields(this.role, this.birth),
      });
      navigate('/verify-email');
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
      this.errors = e instanceof ApiError ? (e.errors ?? { email: [e.message] }) : { email: ['Something went wrong.'] };
    } finally {
      this.busy = false;
    }
  };

  private fieldError(field: string) {
    return this.errors[field] ? <p class="error">{this.errors[field][0]}</p> : null;
  }

  render() {
    if (this.closed !== null || !this.site.registration.open) {
      return (
        <section>
          <h1>Create an account</h1>
          <p class="notice">{this.closed ?? this.site.registration.message ?? 'Registration is closed.'}</p>
        </section>
      );
    }
    if (this.ageBlocked) {
      return (
        <section>
          <h1>Create an account</h1>
          <p class="notice">{UNDER_AGE_NOTICE}</p>
        </section>
      );
    }
    return (
      <section>
        <h1>Create an account</h1>
        <form onSubmit={this.onSubmit}>
          <fieldset>
            <legend>I am a</legend>
            {REGISTRATION_ROLES.map((role) => (
              <label>
                <input type="radio" name="role" value={role} checked={this.role === role} onInput={() => (this.role = role)} />
                {roleLabel(role)}
              </label>
            ))}
          </fieldset>
          {this.fieldError('role')}
          {screensAge(this.role) && renderBirthFields(this.birth, (next) => (this.birth = next))}
          {screensAge(this.role) && this.fieldError('birth_year')}
          <label>
            Name
            <input type="text" required value={this.name} onInput={(e) => (this.name = (e.target as HTMLInputElement).value)} />
          </label>
          {this.fieldError('name')}
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
          <label>
            Confirm password
            <input type="password" required value={this.passwordConfirmation} onInput={(e) => (this.passwordConfirmation = (e.target as HTMLInputElement).value)} />
          </label>
          <button type="submit" class="btn-primary" disabled={this.busy}>Sign up</button>
        </form>
      </section>
    );
  }
}
