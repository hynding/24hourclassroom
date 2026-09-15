import { Component, h, State } from '@stencil/core';
import type { AppNotification } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-notifications', styleUrl: 'page-notifications.css', shadow: true })
export class PageNotifications {
  @State() notifications: AppNotification[] = [];
  @State() loaded = false;
  @State() error = false;
  @State() page = 1;
  @State() lastPage = 1;

  async componentWillLoad() {
    await this.load();
  }

  private async load() {
    // Clear any previous failure so a retry that succeeds doesn't leave a
    // stale error message on screen.
    this.error = false;
    try {
      const result = await profileStore.notifications(this.page > 1 ? this.page : undefined);
      this.notifications = result.data;
      this.lastPage = result.meta.last_page;
      this.loaded = true;
      // Opening the page is what clears the badge -- mark everything read
      // now that the list has actually loaded.
      await profileStore.markRead();
      // app-header is mounted once, persistently, outside the route switch,
      // so navigating here never re-fires its auth subscription and its
      // local `unread` copy would otherwise go stale. Announce the read so
      // it can refetch.
      window.dispatchEvent(new CustomEvent('notifications:read'));
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      // Never fall through to the empty state -- "nothing new" would be a
      // confident, wrong answer to a request that simply failed.
      this.error = true;
    }
  }

  async nextPage() {
    if (this.page >= this.lastPage) {
      return;
    }
    this.page += 1;
    await this.load();
  }

  async previousPage() {
    if (this.page <= 1) {
      return;
    }
    this.page -= 1;
    await this.load();
  }

  private describe(notification: AppNotification) {
    if (notification.type.endsWith('ProfileModerated')) {
      return notification.data.message;
    }
    return notification.data.user?.name;
  }

  render() {
    if (this.error) {
      return (
        <section>
          <h1>Notifications</h1>
          <p class="error">We could not load your notifications.</p>
          <button type="button" class="btn" onClick={() => this.load()}>Retry</button>
        </section>
      );
    }

    if (!this.loaded) {
      return (
        <section>
          <h1>Notifications</h1>
          <p>Loading…</p>
        </section>
      );
    }

    return (
      <section>
        <h1>Notifications</h1>

        {this.notifications.length === 0 ? (
          <p>Nothing new.</p>
        ) : (
          <ul>
            {this.notifications.map((notification) => (
              <li key={notification.id}>{this.describe(notification)}</li>
            ))}
          </ul>
        )}

        {this.lastPage > 1 && (
          <nav aria-label="Notification pages">
            <button type="button" class="btn" disabled={this.page <= 1} onClick={() => this.previousPage()}>
              Previous
            </button>
            <span>
              Page {this.page} of {this.lastPage}
            </span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage} onClick={() => this.nextPage()}>
              Next
            </button>
          </nav>
        )}
      </section>
    );
  }
}
