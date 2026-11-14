import { Component, h, Listen, State } from '@stencil/core';
import { AUTHOR_ROLES, SHARE_RECIPIENT_ROLES, SUPPORTER_ROLES, hasRole } from '@24hc/shared';
import type { SiteConfig, User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';

@Component({ tag: 'page-home', styleUrl: 'page-home.css', shadow: true })
export class PageHome {
  @State() site: SiteConfig = siteStore.config;
  @State() user: User | null = null;

  private unsubscribe: () => void = () => undefined;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  connectedCallback() {
    this.unsubscribe = authStore.subscribe((user) => {
      this.user = user;
    });
    this.user = authStore.currentUser;
  }

  disconnectedCallback() {
    this.unsubscribe();
  }

  /** Allowlist, like app-header: authors write, students take. An admin has no tests shelf. */
  private hasTests(): boolean {
    return this.user !== null && (this.authors() || this.user.role === 'student');
  }

  /** Allowlist, like app-header: authors upload, share recipients receive. */
  private hasMaterials(): boolean {
    return this.user !== null && (this.authors() || hasRole(SHARE_RECIPIENT_ROLES, this.user.role));
  }

  private authors(): boolean {
    return this.user !== null && hasRole(AUTHOR_ROLES, this.user.role);
  }

  /** Allowlist: only an author builds courses. */
  private buildsCourses(): boolean {
    return this.authors();
  }

  /** Allowlist: a tutor, assistant or guardian follows connected students. */
  private supportsStudents(): boolean {
    return this.user !== null && hasRole(SUPPORTER_ROLES, this.user.role);
  }

  private card(path: string, title: string, blurb: string, primary = false) {
    return (
      <li>
        <a class={{ card: true, primary }} href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>
          <strong>{title}</strong>
          <span>{blurb}</span>
        </a>
      </li>
    );
  }

  /**
   * A visitor's first screen. On a phone the menu is behind a button, so
   * the page itself has to say where to go: the two public directories and,
   * while registration is open, the way in.
   */
  private renderGuest() {
    return (
      <ul class="cards" aria-label="Get started">
        {this.card('/library', 'Browse the library', 'Public practice tests, study materials and courses, no account needed.')}
        {this.card('/teachers', 'Find a teacher', 'Teachers by subject and grade level.')}
        {this.site.registration.open
          ? this.card('/register', 'Create an account', 'Teachers share lessons and assign tests; students take them.', true)
          : this.card('/login', 'Sign in', 'Pick up where you left off.', true)}
        {this.site.registration.open && this.card('/login', 'Sign in', 'Already have an account?')}
      </ul>
    );
  }

  /** Shortcuts to the signed-in shelves, the same set the menu offers. */
  private renderMember() {
    return (
      <ul class="cards" aria-label="Your shelves">
        {this.supportsStudents() && this.card('/connections', 'Your students', 'Connect with a student to follow their assignments and scores.', true)}
        {this.hasTests() && this.card('/tests', 'Tests', this.authors() ? 'Write, assign and grade.' : 'Assigned to you, with your results.')}
        {this.hasMaterials() && this.card('/materials', 'Materials', this.authors() ? 'Upload and share study materials.' : 'Shared with you by your teachers.')}
        {this.buildsCourses() && this.card('/courses', 'Courses', 'Order your tests and materials into a course.')}
        {this.card('/library', 'Library', 'Everything published on the site.')}
        {this.card('/teachers', 'Teachers', 'Find and connect with other teachers.')}
      </ul>
    );
  }

  render() {
    const { name, tagline } = this.site.identity;
    return (
      <section>
        <h1>{name}</h1>
        {tagline && <p class="tagline">{tagline}</p>}
        {this.user ? this.renderMember() : this.renderGuest()}
      </section>
    );
  }
}
