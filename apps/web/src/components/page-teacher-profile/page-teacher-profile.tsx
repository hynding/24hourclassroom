import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, PublicProfile, SUBJECTS } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { profileStore } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-teacher-profile', shadow: true })
export class PageTeacherProfile {
  @Prop() teacherId?: number;

  @State() teacher: PublicProfile | null = null;
  @State() notFound = false;
  @State() loadError = false;
  @State() busy = false;

  async componentWillLoad() {
    await this.load();
  }

  private async load() {
    if (!this.teacherId) {
      this.notFound = true;
      return;
    }

    try {
      this.teacher = await profileStore.teacher(this.teacherId);
    } catch (err) {
      // A genuine 404 means the teacher doesn't exist; anything else (network
      // failure, 500, etc.) is transient and should not be reported to the
      // user as "this teacher does not exist".
      if (err instanceof ApiError && err.status === 404) {
        this.notFound = true;
      } else {
        this.loadError = true;
      }
    }
  }

  async toggleFollow() {
    // Loose check: the name-only payload for a student seen by an accepted
    // connection omits is_following entirely rather than setting it to
    // null, and undefined must be treated the same as null here.
    if (!this.teacher || this.teacher.is_following == null) {
      return;
    }
    this.busy = true;
    try {
      await (this.teacher.is_following
        ? profileStore.unfollow(this.teacher.id)
        : profileStore.follow(this.teacher.id));
      await this.load();
    } catch (e) {
      // A stale tab whose connection state changed elsewhere can still
      // click a now-invalid action and get a rejection back. Delegate a
      // session expiry the same way every other action-bearing page does;
      // otherwise resync by reloading so the controls reflect what the
      // server now believes rather than leaving the click unhandled.
      if (!recoverFromExpiredSession(e)) {
        await this.load();
      }
    } finally {
      this.busy = false;
    }
  }

  async connectAction() {
    // See toggleFollow(): loose check catches the name-only payload's
    // omitted is_following as well as an explicit null.
    if (!this.teacher || this.teacher.is_following == null) {
      return;
    }
    const connection = this.teacher.connection;
    this.busy = true;
    try {
      if (!connection) {
        await profileStore.requestConnection(this.teacher.id);
      } else if (connection.status === 'pending' && connection.direction === 'incoming') {
        await profileStore.acceptConnection(connection.id);
      } else {
        await profileStore.removeConnection(connection.id);
      }
      await this.load();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        await this.load();
      }
    } finally {
      this.busy = false;
    }
  }

  private label(options: { value: string; label: string }[], value: string): string {
    return options.find((option) => option.value === value)?.label ?? value;
  }

  private connectLabel(connection: PublicProfile['connection']): string {
    if (!connection) {
      return 'Connect';
    }
    if (connection.status === 'pending' && connection.direction === 'outgoing') {
      return 'Cancel request';
    }
    if (connection.status === 'pending' && connection.direction === 'incoming') {
      return 'Accept';
    }
    return 'Disconnect';
  }

  render() {
    if (this.notFound) {
      return (
        <section>
          <h1>Not found</h1>
          <p>We could not find that teacher.</p>
        </section>
      );
    }

    if (this.loadError) {
      return (
        <section>
          <h1>Something went wrong</h1>
          <p>We could not load that teacher's profile. Please try again.</p>
        </section>
      );
    }

    if (!this.teacher) {
      return <p>Loading…</p>;
    }

    // `profile` is absent entirely for a student seen by an accepted
    // connection: name-only, not an empty object. Every profile-dependent
    // field below must be guarded on its presence.
    const { name, profile, is_following, connection } = this.teacher;

    return (
      <section>
        {profile?.avatar_url && <img src={profile.avatar_url} alt={`${name}'s avatar`} />}
        <h1>{name}</h1>
        {profile?.school && <p>{profile.school}</p>}
        {profile?.bio && <p>{profile.bio}</p>}
        {profile?.specialties && <p>{profile.specialties}</p>}
        {profile && (
          <ul>
            {profile.subjects.map((subject) => (
              <li>{this.label(SUBJECTS, subject)}</li>
            ))}
          </ul>
        )}
        {profile && (
          <ul>
            {profile.grade_levels.map((grade) => (
              <li>{this.label(GRADE_LEVELS, grade)}</li>
            ))}
          </ul>
        )}
        {/*
          Loose check: is_following/connection are absent (undefined), not
          null, on the name-only student payload -- see the comment above.
          The viewer/subject id comparison hides the controls on a teacher's
          own profile, which the directory's lack of self-exclusion makes
          reachable through ordinary navigation, not just a hand-typed URL;
          both follow and connect reject self-targeting server-side.
        */}
        {is_following != null && authStore.currentUser?.id !== this.teacher.id && (
          <div>
            <button type="button" disabled={this.busy} onClick={() => this.toggleFollow()}>
              {is_following ? 'Unfollow' : 'Follow'}
            </button>
            <button type="button" disabled={this.busy} onClick={() => this.connectAction()}>
              {this.connectLabel(connection)}
            </button>
          </div>
        )}
      </section>
    );
  }
}
