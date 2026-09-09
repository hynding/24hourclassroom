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
  @State() generalError: string | null = null;
  @State() saved = false;
  @State() busy = false;
  @State() loaded = false;
  @State() loadError = false;

  async componentWillLoad() {
    await this.load();
  }

  /**
   * Loads the profile and only then allows the editable form to render. A
   * failed load must never fall through to a form pre-filled with the
   * initializer defaults ('', [], null) -- that is indistinguishable from a
   * legitimately empty profile, and saving over it would silently wipe the
   * user's real data (see UpdateProfileRequest's explicit-null semantics).
   * So on failure we set loadError and leave `loaded` false, which keeps
   * render() from ever reaching the <form>.
   */
  private async load() {
    this.loadError = false;
    try {
      const profile = await profileStore.myProfile();
      this.bio = profile.bio ?? '';
      this.school = profile.school ?? '';
      this.specialties = profile.specialties ?? '';
      this.subjects = profile.subjects;
      this.gradeLevels = profile.grade_levels;
      this.avatarUrl = profile.avatar_url;
      this.loaded = true;
    } catch (e) {
      // A logged-out visitor hitting /profile directly fires this same GET
      // before app-root's auth check redirects them away -- that 401 is
      // expected mid-redirect and must not flash an error banner. Any other
      // failure (500, network drop, etc.) is a real, reportable load failure.
      if (e instanceof ApiError && e.status === 401) {
        return;
      }
      this.loadError = true;
    }
  }

  private retry = () => this.load();

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

  /**
   * Routes a caught failure to either the per-field `errors` map (genuine
   * 422 validation errors) or `generalError` (everything else — a 500, a
   * network drop, etc.). Field errors read like "this field is invalid";
   * a general failure is not that, and must not be mislabeled as one.
   */
  private reportFailure(e: unknown, fallback: string) {
    if (e instanceof ApiError && e.errors && Object.keys(e.errors).length > 0) {
      this.errors = e.errors;
    } else {
      this.generalError = e instanceof ApiError ? e.message : fallback;
    }
  }

  submit = async (event: Event) => {
    event.preventDefault();
    this.busy = true;
    this.errors = {};
    this.generalError = null;
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
      this.reportFailure(e, 'Something went wrong.');
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
    this.generalError = null;
    this.saved = false;
    try {
      const profile = await profileStore.uploadAvatar(file);
      this.avatarUrl = profile.avatar_url;
    } catch (e) {
      this.reportFailure(e, 'Upload failed.');
    }
  };

  async removeAvatar() {
    this.errors = {};
    this.generalError = null;
    this.saved = false;
    try {
      await profileStore.removeAvatar();
      this.avatarUrl = null;
    } catch (e) {
      this.reportFailure(e, 'Removal failed.');
    }
  }

  private fieldError(field: string) {
    return this.errors[field] ? <p class="error">{this.errors[field][0]}</p> : null;
  }

  render() {
    if (this.loadError) {
      return (
        <section>
          <h1>My profile</h1>
          <p class="error">We could not load your profile. Please try again.</p>
          <button type="button" onClick={this.retry}>Retry</button>
        </section>
      );
    }

    if (!this.loaded) {
      // Covers both the still-loading state and the guest-mid-redirect 401
      // case -- neither should render the editable form.
      return (
        <section>
          <h1>My profile</h1>
        </section>
      );
    }

    return (
      <section>
        <h1>My profile</h1>
        {this.generalError && <p class="error">{this.generalError}</p>}
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
