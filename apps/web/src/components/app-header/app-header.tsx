import { Component, Element, h, Listen, Prop, State, Watch } from '@stencil/core';
import { AUTHOR_ROLES, REGISTRATION_ROLES, SHARE_RECIPIENT_ROLES, hasRole } from '@24hc/shared';
import type { SiteConfig, User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { profileStore } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';
import { StaleIdentityError } from '../../services/stale-identity';
import { navIcon, NavIcon } from '../../services/nav-icons';
import { LIBRARY_SECTIONS } from '../../services/library-sections';

/** Per-browser memory of the collapsed side panel. A convenience, so a failed read or write is harmless. */
const COLLAPSED_KEY = '24hc.nav.collapsed.v1';

/**
 * The narrow-screen query. The same literal lives in app-header.css and
 * app-layout.css (custom properties cannot drive media queries);
 * breakpoint.spec.ts asserts all three agree.
 */
const NARROW_SCREEN = '(max-width: 767px)';

@Component({ tag: 'app-header', styleUrl: 'app-header.css', shadow: true })
export class AppHeader {
  @Element() el!: HTMLElement;

  @State() user: User | null = null;
  @State() unread = 0;
  @State() site: SiteConfig = siteStore.config;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  /** reflect: true is load-bearing -- app-header.css keys on :host([orientation]). */
  @Prop({ reflect: true }) orientation: 'horizontal' | 'vertical' = 'horizontal';

  /**
   * Side panel narrowed to its icons (wide screens). reflect: true is
   * load-bearing -- app-header.css keys on :host([collapsed]).
   */
  @Prop({ reflect: true, mutable: true }) collapsed = false;

  /**
   * Menu showing as a drawer (narrow screens, either orientation).
   * reflect: true is load-bearing -- app-header.css keys on :host([open]).
   */
  @Prop({ reflect: true, mutable: true }) open = false;

  /** Where focus goes after the next render: into the drawer as it opens, back to its button as it closes. */
  private focusAfterRender: 'drawer' | 'menu' | null = null;

  @Watch('open')
  onOpenChanged(open: boolean) {
    this.focusAfterRender = open ? 'drawer' : 'menu';
  }

  componentDidRender() {
    if (!this.focusAfterRender) {
      return;
    }
    const where = this.focusAfterRender;
    this.focusAfterRender = null;
    const root = this.el.shadowRoot;
    if (!root) {
      return;
    }
    // Closing returns focus only when it was inside the drawer -- a closing
    // tap on the backdrop or a page pick must not yank focus from wherever
    // the page put it.
    if (where === 'menu' && !root.activeElement) {
      return;
    }
    const target = root.querySelector<HTMLElement>(where === 'drawer' ? 'nav a' : 'button.menu');
    target?.focus();
  }

  /**
   * A drawer is a narrow-screen thing. Widening past the breakpoint (a
   * tablet turned sideways) would otherwise leave `open` set with nothing
   * styling it, and the next tap of the menu button would do nothing.
   */
  @Listen('resize', { target: 'window' })
  onResize() {
    if (this.open && typeof window.matchMedia === 'function' && !window.matchMedia(NARROW_SCREEN).matches) {
      this.open = false;
    }
  }

  componentWillLoad() {
    try {
      this.collapsed = window.localStorage.getItem(COLLAPSED_KEY) === '1';
    } catch {
      // Storage can throw in private browsing; the panel simply starts open.
    }
  }

  private toggleCollapsed = () => {
    this.collapsed = !this.collapsed;
    try {
      window.localStorage.setItem(COLLAPSED_KEY, this.collapsed ? '1' : '0');
    } catch {
      // Not remembered this time; nothing else depends on it.
    }
  };

  private toggleOpen = () => {
    this.open = !this.open;
  };

  @Listen('keydown', { target: 'window' })
  onKeydown(event: KeyboardEvent) {
    if (this.open && event.key === 'Escape') {
      this.open = false;
    }
  }

  private unsubscribe: () => void = () => undefined;

  connectedCallback() {
    this.unsubscribe = authStore.subscribe((user) => {
      this.user = user;
      this.loadUnread();
    });
    this.user = authStore.currentUser;
    this.loadUnread();
  }

  disconnectedCallback() {
    this.unsubscribe();
  }

  // app-header is mounted once, persistently, outside the route switch --
  // app-root's renderPage() swaps only <main>'s content -- so navigating to
  // /notifications never re-mounts the header or re-fires the auth
  // subscription. page-notifications announces its markRead() with this
  // event so the header's own `unread` copy doesn't go stale until the next
  // login/logout.
  @Listen('notifications:read', { target: 'window' })
  onNotificationsRead() {
    this.loadUnread();
  }

  private async loadUnread() {
    // Every notification-producing action is behind `verified` on the
    // server, so a signed-out or unverified user can never have one --
    // fetching would be a guaranteed wasted request.
    if (!this.user || !this.user.email_verified_at) {
      this.unread = 0;
      return;
    }
    try {
      this.unread = await profileStore.unreadCount();
    } catch (e) {
      if (e instanceof StaleIdentityError) {
        // This response was issued for a previous identity and the store
        // refused to hand it back. Write NOTHING: the current identity's
        // own loadUnread() -- fired by the same auth change that
        // invalidated this one -- is the only call entitled to this
        // field, and it may already have landed. Falling through would
        // blank a badge that is correct.
        return;
      }
      if (recoverFromExpiredSession(e)) {
        return;
      }
      // A persistent chrome element is the wrong place to surface a
      // transient fetch failure -- leave the badge off rather than adding
      // an error banner to the header.
      this.unread = 0;
    }
  }

  private onNav = (event: MouseEvent, path: string) => {
    event.preventDefault();
    // Picking a page closes the drawer; it is a menu, not a place to stay.
    this.open = false;
    navigate(path);
  };

  private onLogout = async (event: MouseEvent) => {
    event.preventDefault();
    this.open = false;
    await authStore.logout();
    navigate('/');
  };

  /** Allowlist: authors write, students take. An admin, assistant or guardian has no tests shelf. */
  private showsTests(): boolean {
    return this.user !== null && (hasRole(AUTHOR_ROLES, this.user.role) || this.user.role === 'student');
  }

  /** Allowlist: authors upload, share recipients receive. An admin or guardian has no materials shelf. */
  private showsMaterials(): boolean {
    return this.user !== null && (hasRole(AUTHOR_ROLES, this.user.role) || hasRole(SHARE_RECIPIENT_ROLES, this.user.role));
  }

  /**
   * Allowlist: only an author builds courses (the API refuses everyone
   * else a shelf). Everyone finds published courses in the library.
   */
  private showsCourses(): boolean {
    return this.user !== null && hasRole(AUTHOR_ROLES, this.user.role);
  }

  /**
   * Allowlist: every self-assignable role has connection partners
   * (Role::canConnect); an admin has none, so gets no page.
   */
  private showsConnections(): boolean {
    return this.user !== null && hasRole(REGISTRATION_ROLES, this.user.role);
  }

  /**
   * Allowlist: only an author can hold an Anthropic key or an MCP token --
   * every generation endpoint and every MCP tool admits Role::authors() alone.
   */
  private showsIntegrations(): boolean {
    return this.user !== null && hasRole(AUTHOR_ROLES, this.user.role);
  }

  /** One side-panel entry: icon, label (visually hidden when collapsed), and a tooltip. */
  private item(path: string, label: string, icon: NavIcon, extra?: unknown, cls?: string) {
    return (
      <a href={path} class={cls} title={label} onClick={(e) => this.onNav(e, path)}>
        {navIcon(icon)}
        <span class="label">{label}</span>
        {extra}
      </a>
    );
  }

  private renderPanel() {
    const user = this.user;
    const vertical = this.orientation === 'vertical';
    return [
      <header>
        <div class="top">
          <a class="wordmark" href="/" onClick={(e) => this.onNav(e, '/')}>{this.site.identity.name}</a>
          {vertical && (
            <button
              type="button"
              class="icon-button collapse"
              aria-label={this.collapsed ? 'Expand menu' : 'Collapse menu'}
              aria-expanded={this.collapsed ? 'false' : 'true'}
              aria-controls="site-menu"
              title={this.collapsed ? 'Expand menu' : 'Collapse menu'}
              onClick={this.toggleCollapsed}
            >
              {navIcon('panel')}
            </button>
          )}
          <button
            type="button"
            class="icon-button menu"
            aria-label={this.open ? 'Close menu' : 'Open menu'}
            aria-expanded={this.open ? 'true' : 'false'}
            aria-controls="site-menu"
            onClick={this.toggleOpen}
          >
            {navIcon('panel')}
          </button>
        </div>
        <nav id="site-menu" aria-label="Main">
          {this.item('/teachers', 'Teachers', 'teachers')}
          {this.item('/library', 'Library', 'library')}
          {LIBRARY_SECTIONS.map((s) => this.item(s.path, s.title, s.icon, undefined, 'sub'))}
          {this.showsTests() && this.item('/tests', 'Tests', 'tests')}
          {this.showsMaterials() && this.item('/materials', 'Materials', 'materials')}
          {this.showsCourses() && this.item('/courses', 'Courses', 'courses')}
          {this.showsConnections() && this.item('/connections', 'Connections', 'connections')}
          {this.showsIntegrations() && this.item('/integrations', 'Integrations', 'integrations')}
          {user && this.item('/notifications', 'Notifications', 'notifications',
            this.unread > 0 && <span class="badge" data-testid="unread-badge">{this.unread}</span>)}
          {user && this.item('/profile', 'My profile', 'profile')}
        </nav>
        <div class="account">
          {user
            ? [
                <span class="who" title={user.name}>{user.name}</span>,
                <a href="/" title="Log out" onClick={this.onLogout}>
                  {navIcon('logout')}
                  <span class="label">Log out</span>
                </a>,
              ]
            : [
                this.item('/login', 'Sign in', 'login'),
                this.item('/register', 'Sign up', 'register'),
              ]}
        </div>
      </header>,
      // Narrow screens only (CSS): dims the page behind the open drawer and
      // closes it on a tap.
      <div class="backdrop" onClick={() => { this.open = false; }}></div>,
    ];
  }

  /**
   * One markup for both orientations: the stylesheet lays it out as a top
   * bar (horizontal) or a side panel (vertical) on wide screens, and as the
   * same slim bar plus drawer on narrow ones, whichever layout the site
   * owner picked. Only the collapse toggle is the side panel's alone.
   */
  render() {
    return this.renderPanel();
  }
}
