import { Component, h, Listen, State } from '@stencil/core';
import { AUTHOR_ROLES, SHARE_RECIPIENT_ROLES, SUPPORTER_ROLES, hasRole } from '@24hc/shared';
import type { MyAssignment, SiteConfig, User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';
import { testsStore } from '../../services/tests-store';
import { formatDueDate } from '../../services/format';
import { UpNext, upNext } from '../../services/up-next';

/** Rows per list on the home page; the rest wait on /tests. */
const LIST_LIMIT = 5;

@Component({ tag: 'page-home', styleUrl: 'page-home.css', shadow: true })
export class PageHome {
  @State() site: SiteConfig = siteStore.config;
  @State() user: User | null = null;
  /** A student's to-do list; null until loaded (or for anyone else). */
  @State() upNext: UpNext | null = null;
  @State() upNextError = false;
  /** Whose list is loaded, so a re-emitted session does not refetch it. */
  private upNextFor: number | null = null;

  private unsubscribe: () => void = () => undefined;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  connectedCallback() {
    this.unsubscribe = authStore.subscribe((user) => {
      this.user = user;
      this.loadUpNext();
    });
    this.user = authStore.currentUser;
    this.loadUpNext();
  }

  /** The server serves assignments to students only (MyAssignmentsController). */
  private takesTests(): boolean {
    return this.user?.role === 'student';
  }

  private async loadUpNext() {
    if (!this.takesTests()) {
      this.upNext = null;
      this.upNextFor = null;
      return;
    }
    const id = this.user.id;
    if (this.upNextFor === id) {
      return;
    }
    this.upNextFor = id;
    this.upNextError = false;
    try {
      const { data } = await testsStore.myAssignments();
      if (this.user?.id === id) {
        this.upNext = upNext(data);
      }
    } catch {
      this.upNextFor = null;
      this.upNextError = true;
    }
  }

  disconnectedCallback() {
    this.unsubscribe();
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  /** One list of open assignments, at most LIST_LIMIT long. */
  private renderOpen(title: string, cls: string, list: MyAssignment[]) {
    if (list.length === 0) {
      return null;
    }
    return [
      <h3>{title}</h3>,
      <ul class={`rows ${cls}`}>
        {list.slice(0, LIST_LIMIT).map((a) => (
          <li>
            {this.link(`/tests/${a.test.id}`, a.test.title)}
            <span class="meta">due {formatDueDate(a.due_at)}{a.latest ? ' · started' : ''}</span>
          </li>
        ))}
      </ul>,
      list.length > LIST_LIMIT && <p class="meta">and {list.length - LIST_LIMIT} more on {this.link('/tests', 'My tests')}</p>,
    ];
  }

  /**
   * A student's first screen: what is overdue, what is due this week and
   * how they did lately, so they need not dig through a year of
   * assignments on /tests.
   */
  private renderUpNext() {
    if (this.upNextError) {
      return <section class="up-next"><h2>Up next</h2><p>We could not load your assignments. {this.link('/tests', 'Open My tests')}</p></section>;
    }
    const u = this.upNext;
    if (!u) {
      return null;
    }
    const clear = u.overdue.length === 0 && u.thisWeek.length === 0;
    return (
      <section class="up-next" aria-labelledby="up-next-heading">
        <h2 id="up-next-heading">Up next</h2>
        {clear && (
          <p>
            Nothing is due this week.{' '}
            {u.laterCount > 0 ? this.link('/tests', `See all ${u.laterCount} open assignment${u.laterCount === 1 ? '' : 's'}`) : this.link('/library', 'Practise from the library')}
          </p>
        )}
        {this.renderOpen('Overdue', 'overdue', u.overdue)}
        {this.renderOpen('Due this week', 'this-week', u.thisWeek)}
        {!clear && u.laterCount > 0 && <p class="meta">{u.laterCount} more due later on {this.link('/tests', 'My tests')}</p>}
        {u.recent.length > 0 && [
          <h3>Recent scores</h3>,
          <ul class="rows recent">
            {u.recent.slice(0, LIST_LIMIT).map((a) => (
              <li>
                {this.link(`/attempts/${a.latest.id}`, a.test.title)}
                <span class="score">
                  {a.latest.score === null ? 'Awaiting grade' : `${a.latest.score} / ${a.latest.max_score}`}
                  {a.latest.score !== null && a.latest.ungraded_count > 0 ? ` (${a.latest.ungraded_count} to grade)` : ''}
                </span>
              </li>
            ))}
          </ul>,
        ]}
      </section>
    );
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
        {this.user && this.renderUpNext()}
        {this.user ? this.renderMember() : this.renderGuest()}
      </section>
    );
  }
}
