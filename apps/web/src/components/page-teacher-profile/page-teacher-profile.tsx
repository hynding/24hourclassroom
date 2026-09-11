import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, PublicProfile, SUBJECTS } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';

@Component({ tag: 'page-teacher-profile', shadow: true })
export class PageTeacherProfile {
  @Prop() teacherId?: number;

  @State() teacher: PublicProfile | null = null;
  @State() notFound = false;
  @State() loadError = false;

  async componentWillLoad() {
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

  private label(options: { value: string; label: string }[], value: string): string {
    return options.find((option) => option.value === value)?.label ?? value;
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
    const { name, profile } = this.teacher;

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
      </section>
    );
  }
}
