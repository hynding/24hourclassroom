import { Component, h, Listen, Prop, State } from '@stencil/core';
import type { SiteConfig, User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { profileStore } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { navigate } from '../../services/navigate';
import { siteStore } from '../../services/site-store';
import { StaleIdentityError } from '../../services/stale-identity';
import { navIcon, NavIcon } from '../../services/nav-icons';

/** Per-browser memory of the collapsed side panel. A convenience, so a failed read or write is harmless. */
const COLLAPSED_KEY = '24hc.nav.collapsed.v1';

@Component({ tag: 'app-header', styleUrl: 'app-header.css', shadow: true })
export class AppHeader {
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
   * Side panel showing as a drawer (narrow screens). reflect: true is
   * load-bearing -- app-header.css keys on :host([open]).
   */
  @Prop({ reflect: true, mutable: true }) open = false;

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

  /** Allowlist: teachers author, students take. An admin has no tests shelf. */
  private showsTests(): boolean {
    return this.user !== null && (this.user.role === 'teacher' || this.user.role === 'student');
  }

  /** Allowlist: teachers upload, students receive. An admin has no materials shelf. */
  private showsMaterials(): boolean {
    return this.user !== null && (this.user.role === 'teacher' || this.user.role === 'student');
  }

  /**
   * Allowlist: connections exist between teachers and students only (the
   * server refuses every other role), so only they get the page.
   */
  private showsConnections(): boolean {
    return this.user !== null && (this.user.role === 'teacher' || this.user.role === 'student');
  }

  /**
   * Allowlist: only a teacher can hold an Anthropic key or an MCP token --
   * every generation endpoint and every MCP tool admits Role::Teacher alone.
   */
  private showsIntegrations(): boolean {
    return this.user !== null && this.user.role === 'teacher';
  }

  /** One side-panel entry: icon, label (visually hidden when collapsed), and a tooltip. */
  private item(path: string, label: string, icon: NavIcon, extra?: unknown) {
    return (
      <a href={path} title={label} onClick={(e) => this.onNav(e, path)}>
        {navIcon(icon)}
        <span class="label">{label}</span>
        {extra}
      </a>
    );
  }

  private renderPanel() {
    const user = this.user;
    return [
      <header>
        <div class="top">
          <a class="wordmark" href="/" onClick={(e) => this.onNav(e, '/')}>{this.site.identity.name}</a>
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
          {this.showsTests() && this.item('/tests', 'Tests', 'tests')}
          {this.showsMaterials() && this.item('/materials', 'Materials', 'materials')}
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

  render() {
    if (this.orientation === 'vertical') {
      return this.renderPanel();
    }
    return (
      <header>
        <a class="wordmark" href="/" onClick={(e) => this.onNav(e, '/')}>{this.site.identity.name}</a>
        <nav>
          <a href="/teachers" onClick={(e) => this.onNav(e, '/teachers')}>Teachers</a>
          <a href="/library" onClick={(e) => this.onNav(e, '/library')}>Library</a>
          {this.showsTests() && <a href="/tests" onClick={(e) => this.onNav(e, '/tests')}>Tests</a>}
          {this.showsMaterials() && <a href="/materials" onClick={(e) => this.onNav(e, '/materials')}>Materials</a>}
          {this.showsConnections() && <a href="/connections" onClick={(e) => this.onNav(e, '/connections')}>Connections</a>}
          {this.showsIntegrations() && <a href="/integrations" onClick={(e) => this.onNav(e, '/integrations')}>Integrations</a>}
          {this.user
            ? [
                <a href="/notifications" onClick={(e) => this.onNav(e, '/notifications')}>
                  Notifications
                  {this.unread > 0 && <span data-testid="unread-badge">{this.unread}</span>}
                </a>,
                <a href="/profile" onClick={(e) => this.onNav(e, '/profile')}>My profile</a>,
                <span>{this.user.name}</span>,
                <a href="/" onClick={this.onLogout}>Log out</a>,
              ]
            : [
                <a href="/login" onClick={(e) => this.onNav(e, '/login')}>Sign in</a>,
                <a href="/register" onClick={(e) => this.onNav(e, '/register')}>Sign up</a>,
              ]}
        </nav>
      </header>
    );
  }
}
