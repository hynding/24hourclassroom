import { Component, h, Prop, State } from '@stencil/core';
import { GRADE_LEVELS, PublicProfile, SUBJECTS } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';

@Component({ tag: 'page-teacher-profile', shadow: true })
export class PageTeacherProfile {
  @Prop() teacherId?: number;

  @State() teacher: PublicProfile | null = null;
  @State() notFound = false;

  async componentWillLoad() {
    if (!this.teacherId) {
      this.notFound = true;
      return;
    }

    try {
      this.teacher = await profileStore.teacher(this.teacherId);
    } catch {
      this.notFound = true;
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

    if (!this.teacher) {
      return <p>Loading…</p>;
    }

    const { name, profile } = this.teacher;

    return (
      <section>
        {profile.avatar_url && <img src={profile.avatar_url} alt={`${name}'s avatar`} />}
        <h1>{name}</h1>
        {profile.school && <p>{profile.school}</p>}
        {profile.bio && <p>{profile.bio}</p>}
        {profile.specialties && <p>{profile.specialties}</p>}
        <ul>
          {profile.subjects.map((subject) => (
            <li>{this.label(SUBJECTS, subject)}</li>
          ))}
        </ul>
        <ul>
          {profile.grade_levels.map((grade) => (
            <li>{this.label(GRADE_LEVELS, grade)}</li>
          ))}
        </ul>
      </section>
    );
  }
}
