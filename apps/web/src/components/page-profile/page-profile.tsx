import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, GradeLevel, SUBJECTS, Subject } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';

@Component({ tag: 'page-profile', shadow: true })
export class PageProfile {
  @State() bio = '';
  @State() school = '';
  @State() specialties = '';
  @State() subjects: Subject[] = [];
  @State() gradeLevels: GradeLevel[] = [];
  @State() avatarUrl: string | null = null;
  @State() errors: Record<string, string[]> = {};
  @State() saved = false;
  @State() busy = false;

  async componentWillLoad() {
    const profile = await profileStore.myProfile();
    this.bio = profile.bio ?? '';
    this.school = profile.school ?? '';
    this.specialties = profile.specialties ?? '';
    this.subjects = profile.subjects;
    this.gradeLevels = profile.grade_levels;
    this.avatarUrl = profile.avatar_url;
  }

  toggleSubject(value: Subject) {
    this.subjects = this.subjects.includes(value)
      ? this.subjects.filter((s) => s !== value)
      : [...this.subjects, value];
  }

  toggleGrade(value: GradeLevel) {
    this.gradeLevels = this.gradeLevels.includes(value)
      ? this.gradeLevels.filter((g) => g !== value)
      : [...this.gradeLevels, value];
  }

  submit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.errors = {};
    this.saved = false;

    try {
      await profileStore.save({
        bio: this.bio || null,
        school: this.school || null,
        specialties: this.specialties || null,
        subjects: this.subjects,
        grade_levels: this.gradeLevels,
      });
      this.saved = true;
    } catch (e) {
      this.errors = e instanceof ApiError ? (e.errors ?? { bio: [e.message] }) : { bio: ['Something went wrong.'] };
    } finally {
      this.busy = false;
    }
  };

  private onAvatar = async (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (!file) {
      return;
    }

    this.errors = {};
    try {
      const profile = await profileStore.uploadAvatar(file);
      this.avatarUrl = profile.avatar_url;
    } catch (e) {
      this.errors = e instanceof ApiError ? (e.errors ?? { avatar: [e.message] }) : { avatar: ['Upload failed.'] };
    }
  };

  async removeAvatar() {
    await profileStore.removeAvatar();
    this.avatarUrl = null;
  }

  private fieldError(field: string) {
    return this.errors[field] ? <p class="error">{this.errors[field][0]}</p> : null;
  }

  render() {
    return (
      <section>
        <h1>My profile</h1>
        {this.saved && <p>Saved.</p>}

        {this.avatarUrl && [
          <img src={this.avatarUrl} alt="Your avatar" />,
          <button type="button" onClick={() => this.removeAvatar()}>Remove avatar</button>,
        ]}
        <label>
          Avatar
          <input type="file" accept="image/*" onChange={this.onAvatar} />
        </label>
        {this.fieldError('avatar')}

        <form onSubmit={this.submit}>
          <label>
            School
            <input value={this.school} onInput={(e) => (this.school = (e.target as HTMLInputElement).value)} />
          </label>
          {this.fieldError('school')}

          <label>
            Bio
            <textarea onInput={(e) => (this.bio = (e.target as HTMLTextAreaElement).value)}>{this.bio}</textarea>
          </label>
          {this.fieldError('bio')}

          <label>
            Specialties
            <input value={this.specialties} onInput={(e) => (this.specialties = (e.target as HTMLInputElement).value)} />
          </label>
          {this.fieldError('specialties')}

          <fieldset>
            <legend>Subjects</legend>
            {SUBJECTS.map((subject) => (
              <label>
                <input
                  type="checkbox"
                  checked={this.subjects.includes(subject.value)}
                  onChange={() => this.toggleSubject(subject.value)}
                />
                {subject.label}
              </label>
            ))}
          </fieldset>

          <fieldset>
            <legend>Grade levels</legend>
            {GRADE_LEVELS.map((grade) => (
              <label>
                <input
                  type="checkbox"
                  checked={this.gradeLevels.includes(grade.value)}
                  onChange={() => this.toggleGrade(grade.value)}
                />
                {grade.label}
              </label>
            ))}
          </fieldset>

          <button type="submit" disabled={this.busy}>Save profile</button>
        </form>
      </section>
    );
  }
}
