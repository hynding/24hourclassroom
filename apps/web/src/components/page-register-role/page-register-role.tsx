import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import type { RegistrationRole } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';

@Component({ tag: 'page-register-role', styleUrl: 'page-register-role.css', shadow: true })
export class PageRegisterRole {
  @State() role: RegistrationRole = 'teacher';
  @State() error = '';
  @State() busy = false;

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.error = '';
    try {
      await authStore.completeOauth(this.role);
      navigate('/');
    } catch (e) {
      this.error = e instanceof ApiError ? e.message : 'Something went wrong.';
    } finally {
      this.busy = false;
    }
  };

  render() {
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
