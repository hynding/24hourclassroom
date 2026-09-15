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

  /**
   * Follow and connect are both behind `verified` on the server, but
   * /teachers/{id} is exempt from the verification redirect (isPublic() in
   * router.ts) and PublicProfileController is not behind `verified` -- so
   * an unverified viewer receives `is_following: false`, a boolean rather
   * than null, and the render guard below let the controls through. The
   * click then 403s; 403 is not a recovery case, so the page resynced to
   * the identical state and the button simply looked broken.
   */
  private get viewerIsVerified(): boolean {
    return !!authStore.currentUser?.email_verified_at;
  }

  /**
   * The server enforces connections as teacher<->teacher or
   * teacher<->student (spec line 14), guarding the ACTOR as well as the
   * target, so an admin's Connect click 404s. 404 is not a recovery case,
   * so connectAction() resyncs to the identical state and the button looks
   * live while doing nothing -- the same dead affordance as B3's
   * unverified viewer.
   *
   * Scoped to INITIATING, deliberately. The role rules are enforced at
   * creation time only, so an admin may still accept, cancel or disconnect
   * a pre-existing row; those labels stay. Follow is unaffected too -- the
   * spec permits "anyone -> teachers" there.
   */
  private get viewerMayInitiateConnection(): boolean {
    return authStore.currentUser?.role !== 'admin';
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
              <li class="pill">{this.label(SUBJECTS, subject)}</li>
            ))}
          </ul>
        )}
        {profile && (
          <ul>
            {profile.grade_levels.map((grade) => (
              <li class="pill">{this.label(GRADE_LEVELS, grade)}</li>
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
        {is_following != null &&
          authStore.currentUser?.id !== this.teacher.id &&
          (this.viewerIsVerified ? (
            <div>
              <button type="button" class="btn-primary" disabled={this.busy} onClick={() => this.toggleFollow()}>
                {is_following ? 'Unfollow' : 'Follow'}
              </button>
              {connection || this.viewerMayInitiateConnection ? (
                <button type="button" class="btn" disabled={this.busy} onClick={() => this.connectAction()}>
                  {this.connectLabel(connection)}
                </button>
              ) : (
                // `connection` being falsy is exactly the case
                // connectLabel() renders as "Connect", i.e. the initiate
                // affordance -- so an existing row keeps its
                // Accept/Cancel/Disconnect button.
                <p data-testid="admin-connect-hint">
                  Only teachers and students can start a connection.
                </p>
              )}
            </div>
          ) : (
            // Inside the same branch the controls are in, so a viewer who
            // is hidden the controls for another reason -- their own
            // profile, or a payload with no viewer state -- is not told to
            // verify an address they may already have verified.
            <p data-testid="verify-hint">
              Verify your email address to follow or connect with teachers.
            </p>
          ))}
      </section>
    );
  }
}
