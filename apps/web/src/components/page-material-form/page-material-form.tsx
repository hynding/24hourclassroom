import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, GradeLevel, MAX_MATERIAL_BYTES, SUBJECTS, Subject } from '@24hc/shared';
import { materialsStore } from '../../services/materials-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

/**
 * Derived from the cap rather than typed out, so the pre-flight check, the
 * missing-file message and the 413 fallback can never drift from the
 * server's own "Choose a file under {$mb} MB." message.
 */
const FILE_MESSAGE = `Choose a file under ${MAX_MATERIAL_BYTES / (1024 * 1024)} MB.`;

@Component({ tag: 'page-material-form', styleUrl: 'page-material-form.css', shadow: true })
export class PageMaterialForm {
  /** Undefined = creating (/materials/new); set = editing (/materials/:id/edit). */
  @Prop() materialId?: number;

  @State() title = '';
  @State() description = '';
  @State() subject: Subject | '' = '';
  @State() grade: GradeLevel | '' = '';
  @State() file: File | null = null;
  @State() errors: Record<string, string[]> = {};
  @State() message = '';
  @State() busy = false;
  @State() loading = true;
  @State() notFound = false;
  /** Set when a non-author is being navigated away; render() paints nothing. */
  @State() bounced = false;

  async componentWillLoad() {
    if (!this.materialId) {
      this.loading = false;
      return;
    }
    try {
      const material = await materialsStore.getMaterial(this.materialId);
      if (!material.is_author) {
        // Return BEFORE clearing `loading` and render null: C1's test editor
        // flashes its form for a frame because its `finally` clears loading
        // regardless of the bounce.
        this.bounced = true;
        navigate(`/materials/${material.id}`);
        return;
      }
      this.title = material.title;
      this.description = material.description ?? '';
      this.subject = material.subject;
      this.grade = material.grade_level;
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.message = 'We could not load this material.';
      }
    }
    this.loading = false;
  }

  /**
   * Public, and given the event rather than reading a ref: mock-doc has no
   * settable `input.files`, so specs call this directly with
   * `{ target: { files: [new File(...)] } }`.
   */
  onFile(event: Event) {
    this.file = (event.target as HTMLInputElement).files?.[0] ?? null;
    // Clear a stale size error so re-picking a smaller file re-enables
    // submit -- but only the file key: a pending title/subject server
    // error must survive choosing a new file.
    const { file: _file, ...rest } = this.errors;
    this.errors = rest;
    this.message = '';
  }

  async save() {
    const { file: _file, ...rest } = this.errors;
    this.errors = rest;
    this.message = '';

    if (!this.materialId) {
      // Pre-flight, before any request: over the cap is a guaranteed 422 and
      // a wasted upload of up to 10 MB.
      if (!this.file || this.file.size > MAX_MATERIAL_BYTES) {
        this.errors = { file: [FILE_MESSAGE] };
        return;
      }
    }

    this.busy = true;
    try {
      const saved = this.materialId
        ? await materialsStore.updateMaterial(this.materialId, {
            title: this.title,
            description: this.description || null,
            subject: this.subject as Subject,
            grade_level: this.grade as GradeLevel,
          })
        : await materialsStore.uploadMaterial({
            file: this.file,
            ...(this.title ? { title: this.title } : {}),
            ...(this.description ? { description: this.description } : {}),
            subject: this.subject as Subject,
            grade_level: this.grade as GradeLevel,
          });
      navigate(`/materials/${saved.id}`);
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      if (e instanceof ApiError && e.status === 413) {
        // BEFORE any e.message fallback: a body over post_max_size is
        // rejected ahead of validation, so it carries no `errors` and only a
        // generic internal message.
        this.errors = { file: [FILE_MESSAGE] };
      } else if (e instanceof ApiError && e.status === 422) {
        this.errors = e.errors ?? {};
        this.message = 'Please fix the highlighted fields.';
      } else if (e instanceof ApiError && e.status === 403) {
        // Create mode has no client-side role gate, so a non-teacher who
        // navigates straight to /materials/new only finds out after
        // (possibly) uploading a large file. Name the reason instead of
        // falling through to the generic failure message.
        this.message = 'Only teachers can upload materials.';
      } else {
        this.message = 'We could not save this material. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  private fieldError(key: string) {
    const list = this.errors[key];
    return list ? <p class="error">{list[0]}</p> : null;
  }

  render() {
    if (this.bounced) {
      return null;
    }
    if (this.notFound) {
      return <section><h1>Material not found</h1><p>This material does not exist or is not available to you.</p></section>;
    }
    if (this.loading) {
      return <section><p>Loading…</p></section>;
    }
    return (
      <section>
        <h1>{this.materialId ? 'Edit material' : 'Upload a material'}</h1>
        {this.message && <p class="error">{this.message}</p>}
        <form onSubmit={(e) => { e.preventDefault(); this.save(); }}>
          {!this.materialId && [
            <label>
              File
              <input type="file" onChange={(e) => this.onFile(e)} />
            </label>,
            <p class="hint">Up to {MAX_MATERIAL_BYTES / (1024 * 1024)} MB. The file cannot be replaced later — delete and upload again instead.</p>,
          ]}
          {this.fieldError('file')}

          <label>
            Title
            <input
              type="text"
              value={this.title}
              placeholder={this.materialId ? '' : 'Defaults to the file name'}
              onInput={(e) => (this.title = (e.target as HTMLInputElement).value)}
              required={!!this.materialId}
            />
          </label>
          {this.fieldError('title')}

          <label>
            Description
            <textarea value={this.description} onInput={(e) => (this.description = (e.target as HTMLTextAreaElement).value)}></textarea>
          </label>
          {this.fieldError('description')}

          <label>
            Subject
            <select onInput={(e) => (this.subject = (e.target as HTMLSelectElement).value as Subject)} required>
              <option value="" selected={this.subject === ''}>Choose…</option>
              {SUBJECTS.map((s) => <option value={s.value} selected={s.value === this.subject}>{s.label}</option>)}
            </select>
          </label>
          {this.fieldError('subject')}

          <label>
            Grade level
            <select onInput={(e) => (this.grade = (e.target as HTMLSelectElement).value as GradeLevel)} required>
              <option value="" selected={this.grade === ''}>Choose…</option>
              {GRADE_LEVELS.map((g) => <option value={g.value} selected={g.value === this.grade}>{g.label}</option>)}
            </select>
          </label>
          {this.fieldError('grade_level')}

          <div class="actions">
            <button type="submit" class="btn-primary" disabled={this.busy}>
              {this.busy ? 'Saving…' : this.materialId ? 'Save changes' : 'Upload'}
            </button>
            {this.materialId && (
              <a href={`/materials/${this.materialId}`} onClick={(e) => { e.preventDefault(); navigate(`/materials/${this.materialId}`); }}>Cancel</a>
            )}
          </div>
        </form>
      </section>
    );
  }
}
