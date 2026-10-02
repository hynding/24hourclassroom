import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, Question, SUBJECTS, TestView } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { assertNever } from '../../services/assert-never';
import { keyFor, showsStimulus } from '../../services/question-format';

const LONG_ANSWER_RULES = 8;

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

  /** The space left for a written answer -- nothing for option types, whose choices are the answer space. */
  private renderAnswerSpace(q: Question) {
    switch (q.type) {
      case 'multiple_choice':
      case 'multi_select':
      case 'fill_blank':
        return null;
      case 'true_false':
        return <p class="tf"><span>☐ True</span><span>☐ False</span></p>;
      case 'short_answer':
      case 'numeric':
        return <div class="answer-line"></div>;
      case 'long_answer':
        return <div class="answer-block">{Array.from({ length: LONG_ANSWER_RULES }, () => <div class="rule"></div>)}</div>;
      default:
        return assertNever(q.type, 'question type');
    }
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
          {t.questions.map((q, i) => (
            <li>
              {showsStimulus(t.questions, i) && <div class="stimulus"><rich-text text={q.stimulus}></rich-text></div>}
              <div class="prompt"><rich-text text={q.prompt}></rich-text> <span class="meta">({q.points} pt{q.points === 1 ? '' : 's'})</span></div>
              {q.options && (
                <ol class="options">{q.options.map((opt) => <li>{opt}</li>)}</ol>
              )}
              {this.renderAnswerSpace(q)}
            </li>
          ))}
        </ol>
        {this.wantsKey && hasAnswers && (
          <section class="key">
            <h2>Answer key</h2>
            <ol>{t.questions.map((q) => <li>{keyFor(q, q.answer)}</li>)}</ol>
          </section>
        )}
        <button type="button" class="btn no-print" onClick={() => window.print()}>Print</button>
      </article>
    );
  }
}
