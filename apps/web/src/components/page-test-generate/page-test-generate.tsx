import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import {
  GENERATION_MAX_MATERIALS,
  GENERATION_MAX_QUESTIONS,
  GENERATION_MIN_QUESTIONS,
  GRADE_LEVELS,
  GradeLevel,
  MaterialSummary,
  SUBJECTS,
  Subject,
} from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { generationStore } from '../../services/generation-store';
import { materialsStore } from '../../services/materials-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-test-generate', styleUrl: 'page-test-generate.css', shadow: true })
export class PageTestGenerate {
  @State() title = '';
  @State() subject: Subject | '' = '';
  @State() grade: GradeLevel | '' = '';
  @State() instructions = '';
  @State() questionCount = 10;
  @State() materials: MaterialSummary[] = [];
  @State() selected: number[] = [];
  @State() errors: Record<string, string[]> = {};
  @State() message = '';
  /** True when `message` is the missing-key 422 and needs the link beside it. */
  @State() needsKey = false;
  @State() busy = false;
  @State() loading = true;

  /** Allowlist: anything that is not exactly teacher gets the empty state. */
  private get role(): 'teacher' | 'none' {
    return authStore.currentUser?.role === 'teacher' ? 'teacher' : 'none';
  }

  async componentWillLoad() {
    // app-root renders the routed page before authStore.load() resolves, and
    // `role` is a plain getter, so reading it first would latch the empty
    // state on every hard load and never recover.
    await authStore.load();
    if (this.role !== 'teacher') {
      this.loading = false;
      return;
    }
    // Own materials only (first page): each selected file is uploaded into
    // the teacher's OWN Anthropic organisation, so a material another
    // teacher shared with them is theirs to read, never to export.
    try {
      const result = await materialsStore.listMaterials();
      this.materials = result.data;
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.message = 'We could not load your materials.';
      }
    }
    // Read the way page-test-print reads ?key=1. The router matches
    // /tests/generate on the pathname alone, so the query survives the
    // exact-route match and "Try again" can prefill from a failed run.
    const from = new URLSearchParams(window.location.search).get('from');
    const fromId = Number(from);
    if (from !== null && from !== '' && Number.isInteger(fromId) && fromId > 0) {
      await this.prefill(fromId);
    }
    this.loading = false;
  }

  private async prefill(id: number) {
    try {
      const previous = await generationStore.getGeneration(id);
      this.title = previous.title;
      this.subject = previous.subject;
      this.grade = previous.grade_level;
      this.instructions = previous.instructions ?? '';
      this.questionCount = previous.question_count;
      this.selected = previous.material_ids;
    } catch (e) {
      // Keep whichever message landed first: a failed materials load already
      // explains the page, and the prefill failure would only bump it.
      if (!recoverFromExpiredSession(e) && this.message === '') {
        // A prefill is a convenience: an unreadable source row leaves an
        // empty form rather than a dead end.
        this.message = 'We could not load that generation to copy.';
      }
    }
  }

  /** Public: the specs drive selection through it rather than clicking boxes. */
  toggleMaterial(id: number) {
    const alreadySelected = this.selected.includes(id);
    // The `disabled` attribute is only the affordance; the cap has to hold
    // here too, since the specs (and any future caller) drive this directly.
    if (!alreadySelected && this.selected.length >= GENERATION_MAX_MATERIALS) {
      return;
    }
    this.selected = alreadySelected
      ? this.selected.filter((m) => m !== id)
      : [...this.selected, id];
  }

  async generate() {
    this.errors = {};
    this.message = '';
    this.needsKey = false;
    this.busy = true;
    try {
      const generation = await generationStore.createGeneration({
        title: this.title,
        subject: this.subject as Subject,
        grade_level: this.grade as GradeLevel,
        instructions: this.instructions || null,
        question_count: this.questionCount,
        material_ids: this.selected,
      });
      navigate(`/generations/${generation.id}`);
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      if (e instanceof ApiError && e.status === 422 && e.errors?.api_key) {
        // Not a field error: the fix is on another page, so render the link.
        this.needsKey = true;
        this.message = e.errors.api_key[0];
      } else if (e instanceof ApiError && e.status === 422) {
        this.errors = e.errors ?? {};
        this.message = 'Please fix the highlighted fields.';
      } else if (e instanceof ApiError && e.status === 404) {
        // The server answers 404 (never 422 or 403) for a material id that is
        // not the teacher's own, so the whole request failed on one id.
        this.message = 'One of the selected materials is not available.';
      } else if (e instanceof ApiError && e.status === 403) {
        this.message = 'Only teachers can generate tests.';
      } else {
        this.message = 'We could not start that generation. Please try again.';
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
    if (this.role !== 'teacher') {
      return (
        <section>
          <h1>Generate a test</h1>
          <p>Only teachers can generate tests.</p>
        </section>
      );
    }
    if (this.loading) {
      return <section><p>Loading…</p></section>;
    }
    const atCap = this.selected.length >= GENERATION_MAX_MATERIALS;
    return (
      <section>
        <h1>Generate a test</h1>
        <p class="hint">
          Claude drafts a private test from your own materials, on your own Anthropic key. You edit it afterwards.
        </p>
        {this.message && (
          <p class="error">
            {this.message}
            {this.needsKey && ' '}
            {this.needsKey && (
              <a href="/integrations" onClick={(e) => { e.preventDefault(); navigate('/integrations'); }}>
                Add your Anthropic API key
              </a>
            )}
          </p>
        )}
        <form onSubmit={(e) => { e.preventDefault(); this.generate(); }}>
          <label>
            Title
            <input
              type="text"
              value={this.title}
              onInput={(e) => (this.title = (e.target as HTMLInputElement).value)}
              required
            />
          </label>
          {this.fieldError('title')}

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

          <label>
            Instructions
            <textarea
              value={this.instructions}
              onInput={(e) => (this.instructions = (e.target as HTMLTextAreaElement).value)}
            ></textarea>
          </label>
          {this.fieldError('instructions')}

          <label>
            Questions
            <input
              type="number"
              min={GENERATION_MIN_QUESTIONS}
              max={GENERATION_MAX_QUESTIONS}
              value={this.questionCount}
              onInput={(e) => (this.questionCount = Number((e.target as HTMLInputElement).value))}
            />
          </label>
          {this.fieldError('question_count')}

          <fieldset>
            <legend>Materials</legend>
            <p class="hint">{this.selected.length} of {GENERATION_MAX_MATERIALS} selected</p>
            {this.materials.length === 0 && <p>You have no materials to draw on yet.</p>}
            <ul class="rows">
              {this.materials.map((m) => (
                <li>
                  <label class="check">
                    <input
                      type="checkbox"
                      checked={this.selected.includes(m.id)}
                      disabled={atCap && !this.selected.includes(m.id)}
                      onChange={() => this.toggleMaterial(m.id)}
                    />
                    {m.title}
                  </label>
                </li>
              ))}
            </ul>
          </fieldset>
          {this.fieldError('material_ids')}

          <div class="actions">
            <button type="submit" class="btn-primary" disabled={this.busy}>
              {this.busy ? 'Starting…' : 'Generate'}
            </button>
            <a href="/tests" onClick={(e) => { e.preventDefault(); navigate('/tests'); }}>Cancel</a>
          </div>
        </form>
      </section>
    );
  }
}
