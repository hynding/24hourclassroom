import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, Question, SUBJECTS, TestView } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-test-print', styleUrl: 'page-test-print.css', shadow: true })
export class PageTestPrint {
  @Prop() testId?: number;

  @State() test: TestView | null = null;
  @State() notFound = false;
  @State() error = false;

  async componentWillLoad() {
    if (!this.testId) {
      this.notFound = true;
      return;
    }
    try {
      this.test = await testsStore.getTest(this.testId);
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = true;
      }
    }
  }

  /** The server strips answers for non-authors, so this flag alone reveals nothing. */
  private get wantsKey(): boolean {
    return new URLSearchParams(window.location.search).get('key') === '1';
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  private letter(i: number) {
    return String.fromCharCode(65 + i);
  }

  private keyFor(q: Question): string {
    if (q.options && typeof q.answer === 'number') {
      return this.letter(q.answer);
    }
    if (q.options && Array.isArray(q.answer)) {
      return q.answer.map((i: number) => this.letter(i)).join(', ');
    }
    if (q.type === 'true_false') {
      return q.answer ? 'True' : 'False';
    }
    if (q.type === 'numeric' && q.answer && typeof q.answer === 'object') {
      const a = q.answer as { value: number; tolerance?: number };
      return a.tolerance ? `${a.value} ± ${a.tolerance}` : String(a.value);
    }
    return String(q.answer);
  }

  render() {
    if (this.notFound) {
      return <article><h1>Test not found</h1></article>;
    }
    if (this.error) {
      return <article><p>We could not load this test.</p></article>;
    }
    if (!this.test) {
      return <article><p>Loading…</p></article>;
    }
    const t = this.test;
    const hasAnswers = t.questions.some((q) => 'answer' in q);
    return (
      <article>
        <header>
          <h1>{t.title}</h1>
          <p class="meta">{this.label(SUBJECTS, t.subject)} · {this.label(GRADE_LEVELS, t.grade_level)} · {t.author.name}</p>
          <p class="name-line">Name: ______________________________ Date: ______________</p>
          {t.description && <p class="instructions">{t.description}</p>}
        </header>
        <ol class="questions">
          {t.questions.map((q) => (
            <li>
              <p class="prompt">{q.prompt} <span class="meta">({q.points} pt{q.points === 1 ? '' : 's'})</span></p>
              {q.options && (
                <ol class="options">{q.options.map((opt) => <li>{opt}</li>)}</ol>
              )}
              {q.type === 'true_false' && <p>☐ True &nbsp;&nbsp; ☐ False</p>}
              {(q.type === 'short_answer' || q.type === 'numeric') && <div class="answer-line"></div>}
            </li>
          ))}
        </ol>
        {this.wantsKey && hasAnswers && (
          <section class="key">
            <h2>Answer key</h2>
            <ol>{t.questions.map((q) => <li>{this.keyFor(q)}</li>)}</ol>
          </section>
        )}
        <button type="button" class="btn no-print" onClick={() => window.print()}>Print</button>
      </article>
    );
  }
}
