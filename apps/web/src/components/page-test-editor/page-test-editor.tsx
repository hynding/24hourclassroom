import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, GradeLevel, QuestionInput, SUBJECTS, Subject, TestInput, TestView } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { blankQuestion } from '../../services/question-shapes';

@Component({ tag: 'page-test-editor', styleUrl: 'page-test-editor.css', shadow: true })
export class PageTestEditor {
  /** Undefined = creating a new test. */
  @Prop() testId?: number;

  @State() title = '';
  @State() description = '';
  @State() subject: Subject | '' = '';
  @State() grade: GradeLevel | '' = '';
  @State() questions: QuestionInput[] = [blankQuestion('multiple_choice')];
  @State() errors: Record<string, string[]> = {};
  @State() message = '';
  @State() busy = false;
  @State() loading = true;
  @State() notFound = false;

  async componentWillLoad() {
    if (!this.testId) {
      this.loading = false;
      return;
    }
    try {
      const test = await testsStore.getTest(this.testId);
      if (!test.is_author) {
        navigate(`/tests/${test.id}`);
        return;
      }
      this.fill(test);
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.message = 'We could not load this test.';
      }
    } finally {
      this.loading = false;
    }
  }

  private fill(test: TestView) {
    this.title = test.title;
    this.description = test.description ?? '';
    this.subject = test.subject;
    this.grade = test.grade_level;
    this.questions = test.questions.map((q) => ({
      id: q.id,
      type: q.type,
      prompt: q.prompt,
      ...(q.options ? { options: q.options } : {}),
      answer: q.answer,
      points: q.points,
      ...(q.type === 'multi_select' ? { partial_credit: q.partial_credit } : {}),
      explanation: q.explanation ?? null,
    }));
  }

  private body(): TestInput {
    return {
      title: this.title,
      description: this.description || null,
      subject: this.subject as Subject,
      grade_level: this.grade as GradeLevel,
      questions: this.questions,
    };
  }

  async save() {
    this.busy = true;
    this.errors = {};
    this.message = '';
    try {
      const saved = this.testId
        ? await testsStore.updateTest(this.testId, this.body())
        : await testsStore.createTest(this.body());
      navigate(`/tests/${saved.id}`);
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      if (e instanceof ApiError && e.status === 422) {
        this.errors = e.errors ?? {};
        this.message = 'Please fix the highlighted fields.';
      } else {
        this.message = 'We could not save the test. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  private update(i: number, q: QuestionInput) {
    this.questions = this.questions.map((existing, j) => (j === i ? q : existing));
  }

  private remove(i: number) {
    if (this.questions.length === 1) {
      return;
    }
    this.questions = this.questions.filter((_, j) => j !== i);
  }

  private move(i: number, dir: -1 | 1) {
    const j = i + dir;
    if (j < 0 || j >= this.questions.length) {
      return;
    }
    const next = [...this.questions];
    [next[i], next[j]] = [next[j], next[i]];
    this.questions = next;
  }

  private add() {
    if (this.questions.length >= 100) {
      return;
    }
    this.questions = [...this.questions, blankQuestion('multiple_choice')];
  }

  private fieldError(key: string) {
    const list = this.errors[key];
    return list ? <p class="error">{list[0]}</p> : null;
  }

  render() {
    if (this.notFound) {
      return <section><h1>Test not found</h1></section>;
    }
    if (this.loading) {
      return <section><p>Loading…</p></section>;
    }
    return (
      <section>
        <h1>{this.testId ? 'Edit test' : 'New test'}</h1>
        {this.message && <p class="error">{this.message}</p>}
        <form onSubmit={(e) => { e.preventDefault(); this.save(); }}>
          <label>
            Title
            <input type="text" value={this.title} onInput={(e) => (this.title = (e.target as HTMLInputElement).value)} required />
          </label>
          {this.fieldError('title')}
          <label>
            Description
            <textarea value={this.description} onInput={(e) => (this.description = (e.target as HTMLTextAreaElement).value)}></textarea>
          </label>
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

          <h2>Questions</h2>
          {this.fieldError('questions')}
          <div class="questions">
            {this.questions.map((q, i) => [
              // Rendered here too, not only passed to the child: the child
              // has its own shadow root, so its own display of this text
              // is invisible to anything that inspects this page's DOM.
              this.fieldError(`questions.${i}`),
              <test-question-editor
                question={q}
                index={i}
                error={this.errors[`questions.${i}`]?.[0]}
                onQuestionChange={(e: CustomEvent<QuestionInput>) => this.update(i, e.detail)}
                onQuestionRemove={() => this.remove(i)}
                onQuestionMove={(e: CustomEvent<-1 | 1>) => this.move(i, e.detail)}
              ></test-question-editor>,
            ])}
          </div>
          <button type="button" class="btn" onClick={() => this.add()} disabled={this.questions.length >= 100}>Add question</button>

          <div class="actions">
            <button type="submit" class="btn-primary" disabled={this.busy}>{this.testId ? 'Save changes' : 'Create test'}</button>
            {this.testId && <a href={`/tests/${this.testId}`} onClick={(e) => { e.preventDefault(); navigate(`/tests/${this.testId}`); }}>Cancel</a>}
          </div>
        </form>
      </section>
    );
  }
}
