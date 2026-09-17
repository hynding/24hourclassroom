import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { AttemptSummary, GRADE_LEVELS, Question, SUBJECTS, TestView } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { testsStore } from '../../services/tests-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { formatDueDate } from '../../services/format';

@Component({ tag: 'page-test', styleUrl: 'page-test.css', shadow: true })
export class PageTest {
  @Prop() testId?: number;

  @State() test: TestView | null = null;
  @State() attempts: AttemptSummary[] = [];
  @State() notFound = false;
  @State() loadError = false;
  @State() busy = false;
  @State() actionError = '';

  async componentWillLoad() {
    // Same reason as page-tests: `viewer` is a plain getter, so the role has
    // to be known before isStudent decides whether to offer Start attempt.
    await authStore.load();
    await this.load();
  }

  private get viewer() {
    return authStore.currentUser;
  }

  /** Allowlist: only a student takes tests. */
  private get isStudent(): boolean {
    return this.viewer?.role === 'student';
  }

  private async load() {
    if (!this.testId) {
      this.notFound = true;
      return;
    }
    try {
      this.test = await testsStore.getTest(this.testId);
      if (this.isStudent) {
        const mine = await testsStore.myAttempts();
        this.attempts = mine.data.filter((a) => a.test_id === this.testId);
      }
    } catch (err) {
      if (err instanceof ApiError && err.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(err)) {
        this.loadError = true;
      }
    }
  }

  private async run(action: () => Promise<void>) {
    this.busy = true;
    this.actionError = '';
    try {
      await action();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.actionError = e instanceof ApiError ? e.message : 'Something went wrong.';
      }
    } finally {
      this.busy = false;
    }
  }

  private start = () => this.run(async () => {
    const attempt = await testsStore.startAttempt(this.test.id);
    navigate(`/attempts/${attempt.id}`);
  });

  private copy = () => this.run(async () => {
    const copy = await testsStore.copyTest(this.test.id);
    navigate(`/tests/${copy.id}/edit`);
  });

  private togglePublish = () => this.run(async () => {
    const updated = this.test.visibility === 'public'
      ? await testsStore.unpublishTest(this.test.id)
      : await testsStore.publishTest(this.test.id);
    this.test = { ...this.test, ...updated };
  });

  private remove = () => {
    // Ask BEFORE run(): entering run() flips `busy` (disabling every action
    // button) for a dialog the teacher may still cancel. And it has to be
    // `window.confirm`, not the bare global -- Stencil's newSpecPage resets
    // the mock window, so a spec can only stub the property after mount.
    if (!window.confirm('Delete this test and every student attempt on it? This cannot be undone.')) {
      return;
    }
    return this.run(async () => {
      await testsStore.deleteTest(this.test.id);
      navigate('/tests');
    });
  };

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  private renderQuestion(q: Question, index: number) {
    const hasAnswer = 'answer' in q;
    return (
      <li>
        <p class="prompt">{index + 1}. {q.prompt} <span class="points">({q.points} pt{q.points === 1 ? '' : 's'})</span></p>
        {q.options && (
          <ol class="options">
            {q.options.map((opt, i) => (
              <li class={hasAnswer && this.isCorrect(q, i) ? 'correct' : ''}>{opt}</li>
            ))}
          </ol>
        )}
        {hasAnswer && !q.options && <p class="answer">Correct answer: {this.formatAnswer(q)}</p>}
        {hasAnswer && q.explanation && <p class="explanation">{q.explanation}</p>}
      </li>
    );
  }

  private isCorrect(q: Question, index: number): boolean {
    return Array.isArray(q.answer) ? q.answer.includes(index) : q.answer === index;
  }

  private formatAnswer(q: Question): string {
    if (q.type === 'numeric') {
      const a = q.answer as { value: number; tolerance?: number };
      return a.tolerance ? `${a.value} ± ${a.tolerance}` : String(a.value);
    }
    return String(q.answer);
  }

  render() {
    if (this.notFound) {
      return <section><h1>Test not found</h1><p>This test does not exist or is not available to you.</p></section>;
    }
    if (this.loadError) {
      return <section><h1>Test</h1><p>We could not load this test. Please try again.</p></section>;
    }
    if (!this.test) {
      return <section><p>Loading…</p></section>;
    }
    const t = this.test;
    return (
      <section>
        <header>
          <h1>{t.title}</h1>
          <p class="meta">
            {this.label(SUBJECTS, t.subject)} · {this.label(GRADE_LEVELS, t.grade_level)} · {t.question_count} questions · by {t.author.name}
            {t.visibility === 'public' ? ' · Public' : ' · Private'}
          </p>
          {t.description && <p>{t.description}</p>}
        </header>

        {this.actionError && <p class="error">{this.actionError}</p>}

        {t.is_author && (
          <div class="actions">
            {this.link(`/tests/${t.id}/edit`, 'Edit')}
            {this.link(`/tests/${t.id}/assign`, 'Assign')}
            {this.link(`/tests/${t.id}/results`, 'Results')}
            {this.link(`/tests/${t.id}/print`, 'Print')}
            <button type="button" class="btn" disabled={this.busy} onClick={this.togglePublish}>
              {t.visibility === 'public' ? 'Unpublish' : 'Publish to library'}
            </button>
            <button type="button" class="btn" disabled={this.busy} onClick={this.remove}>Delete</button>
          </div>
        )}

        {!t.is_author && this.isStudent && (
          <div class="actions">
            {t.assignment?.due_at && <p>Due {formatDueDate(t.assignment.due_at)}</p>}
            <button type="button" class="btn-primary" disabled={this.busy} onClick={this.start}>
              {t.open_attempt_id ? 'Continue attempt' : 'Start attempt'}
            </button>
          </div>
        )}

        {t.can_copy && (
          <div class="actions">
            <button type="button" class="btn" disabled={this.busy} onClick={this.copy}>Copy to my tests</button>
          </div>
        )}

        {this.isStudent && this.attempts.length > 0 && (
          <div>
            <h2>Your attempts</h2>
            <ul>
              {this.attempts.map((a) => (
                <li>
                  {this.link(`/attempts/${a.id}`, a.submitted_at ? `Submitted ${new Date(a.submitted_at).toLocaleString()}` : 'In progress')}
                  {a.submitted_at && ` — ${a.score} / ${a.max_score}${a.ungraded_count ? ` (${a.ungraded_count} awaiting grading)` : ''}`}
                </li>
              ))}
            </ul>
          </div>
        )}

        <h2>Questions</h2>
        <ol class="questions">{t.questions.map((q, i) => this.renderQuestion(q, i))}</ol>
        {!t.is_author && this.link(`/tests/${t.id}/print`, 'Printable version')}
      </section>
    );
  }
}
