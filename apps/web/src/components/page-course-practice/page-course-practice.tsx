import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { PracticeResult, PracticeTest, Question } from '@24hc/shared';
import { coursesStore } from '../../services/courses-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { courseItemTitle } from '../../services/course-format';
import { practiceMeta, setPageMeta } from '../../services/page-meta';
import { QuestionInput } from '../../services/question-input';
import { formatAnswer, formatResponse, isTextResponse, optionChosen, showsStimulus } from '../../services/question-format';

/**
 * Practice mode for a course's test, open to anyone who can see the course.
 * Two ways through, and the visitor can mix them: reveal any one answer as
 * they go, or finish and see every answer with a score. Nothing is stored --
 * responses live in this component and vanish with it -- so there is no
 * autosave and no attempt; "finish" is one stateless check the server
 * grades with the same scorer a real attempt uses.
 */
@Component({ tag: 'page-course-practice', styleUrl: 'page-course-practice.css', shadow: true })
export class PageCoursePractice {
  @Prop() courseId?: number;
  @Prop() testId?: number;

  @State() test: PracticeTest | null = null;
  @State() responses: Record<number, unknown> = {};
  /** Question ids whose answer the visitor has shown. */
  @State() revealed: Record<number, boolean> = {};
  @State() result: PracticeResult | null = null;
  @State() notFound = false;
  @State() loadError = false;
  @State() busy = false;
  @State() error = '';

  async componentWillLoad() {
    if (!this.courseId || !this.testId) {
      this.notFound = true;
      return;
    }
    try {
      this.test = await coursesStore.getPracticeTest(this.courseId, this.testId);
      setPageMeta(practiceMeta(this.test));
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.loadError = true;
      }
    }
  }

  setResponse(questionId: number, value: unknown) {
    this.responses = { ...this.responses, [questionId]: value };
  }

  toggleReveal(questionId: number) {
    this.revealed = { ...this.revealed, [questionId]: !this.revealed[questionId] };
  }

  async finish() {
    this.busy = true;
    this.error = '';
    try {
      this.result = await coursesStore.checkPractice(this.test.course.id, this.test.id, this.responses);
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        // Unpublished (or the test taken out of the course) since the load.
        this.test = null;
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = e instanceof ApiError && e.status === 422 ? e.message : 'We could not check your answers. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  retry() {
    this.responses = {};
    this.revealed = {};
    this.result = null;
    this.error = '';
    window.scrollTo?.(0, 0);
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  private awarded(q: Question): number | null | undefined {
    return this.result?.results.find((r) => r.question_id === q.id)?.awarded;
  }

  /** right / partial / wrong / self (no scorer can mark it), or '' before finishing. */
  private status(q: Question): string {
    if (!this.result) {
      return '';
    }
    const awarded = this.awarded(q);
    if (awarded === null || awarded === undefined) {
      return 'self';
    }
    return awarded >= q.points ? 'right' : awarded > 0 ? 'partial' : 'wrong';
  }

  /** The label beside a non-option answer; only two types word it differently. */
  private answerLabel(q: Question): string {
    return q.type === 'fill_blank' ? 'Accepted answers' : q.type === 'long_answer' ? 'Model answer' : 'Correct answer';
  }

  /**
   * The answer, its rationale and explanation. After finishing it also
   * shows what the visitor put down; before, the inputs above already do.
   */
  private renderKey(q: Question) {
    const finished = this.result !== null;
    const response = this.responses[q.id];
    const explained = (q.type === 'multiple_choice' || q.type === 'multi_select') && Array.isArray(q.options);
    const skipped = response === null || response === undefined || response === '' || (Array.isArray(response) && response.length === 0);
    return (
      <div class="key" id={`key-${q.id}`}>
        {explained
          ? [
              finished && skipped && <p>Your answer: <strong>{formatResponse(q, null)}</strong></p>,
              <ol class="options explained">
                {q.options.map((opt, i) => {
                  const picked = finished && optionChosen(response, i);
                  const correct = optionChosen(q.answer, i);
                  return (
                    <li class={{ picked, correct }}>
                      <span class="option-text">{opt}</span>
                      {picked && <span class="meta"> (your answer)</span>}
                      {correct && <span class="meta"> (correct)</span>}
                      {q.option_explanations?.[i] && <div class="rationale"><rich-text text={q.option_explanations[i]}></rich-text></div>}
                    </li>
                  );
                })}
              </ol>,
            ]
          : [
              finished && (isTextResponse(q.type)
                ? [<p>Your answer:</p>, <p class="response">{formatResponse(q, skipped ? null : response)}</p>]
                : <p>Your answer: <strong>{formatResponse(q, skipped ? null : response)}</strong></p>),
              <p>{this.answerLabel(q)}: {formatAnswer(q, q.answer)}</p>,
            ]}
        {q.explanation && <div class="explanation"><rich-text text={q.explanation}></rich-text></div>}
      </div>
    );
  }

  private renderQuestion(q: Question, index: number, questions: Question[]) {
    const finished = this.result !== null;
    const shown = finished || !!this.revealed[q.id];
    const awarded = this.awarded(q);
    return (
      <li class={this.status(q)}>
        {showsStimulus(questions, index) && <div class="stimulus"><rich-text text={q.stimulus}></rich-text></div>}
        <div class="prompt"><span class="num">{index + 1}.</span> <rich-text text={q.prompt}></rich-text> <span class="meta">({q.points} pt{q.points === 1 ? '' : 's'})</span></div>
        {!finished && <QuestionInput question={q} value={this.responses[q.id]} onChange={(value) => this.setResponse(q.id, value)} />}
        {!finished && (
          <button type="button" class="btn reveal" aria-expanded={shown ? 'true' : 'false'} aria-controls={`key-${q.id}`} onClick={() => this.toggleReveal(q.id)}>
            {shown ? 'Hide answer' : 'Show answer'}
          </button>
        )}
        {shown && this.renderKey(q)}
        {finished && (
          <p class="meta mark">
            {awarded === null || awarded === undefined ? 'Not marked automatically: compare your answer with the one above.' : `${awarded} / ${q.points}`}
            {this.revealed[q.id] && ' · answer shown before finishing'}
          </p>
        )}
      </li>
    );
  }

  render() {
    if (this.notFound) {
      return <section><h1>Practice not available</h1><p>This test is not part of a course available to you.</p></section>;
    }
    if (this.loadError) {
      return <section><h1>Practice</h1><p>We could not load this test. Please try again.</p></section>;
    }
    if (!this.test) {
      return <section><p>Loading…</p></section>;
    }
    const t = this.test;
    const r = this.result;
    return (
      <section>
        <p class="crumb">{this.link(`/courses/${t.course.id}`, t.course.title)}</p>
        <h1>{courseItemTitle(t.course.title, t.title)}</h1>
        <p class="meta">{t.question_count} question{t.question_count === 1 ? '' : 's'} · practice mode, nothing is saved</p>
        {t.description && <rich-text blocks text={t.description}></rich-text>}

        {r
          ? (
            <div class="result" role="status">
              <p class="score">You scored {r.score} / {r.max_score}</p>
              {r.ungraded_count > 0 && (
                <p class="meta">{r.ungraded_count} answer{r.ungraded_count === 1 ? ' is' : 's are'} not marked automatically and not counted: compare {r.ungraded_count === 1 ? 'it' : 'them'} with the answer shown below.</p>
              )}
            </div>
          )
          : <p class="notice">Answer the questions and finish to see your results, or show any answer as you go.</p>}

        {this.error && <p class="error">{this.error}</p>}

        <ol class="questions">{t.questions.map((q, i) => this.renderQuestion(q, i, t.questions))}</ol>

        <div class="actions">
          {r
            ? <button type="button" class="btn-primary" onClick={() => this.retry()}>Try again</button>
            : <button type="button" class="btn-primary" disabled={this.busy} onClick={() => this.finish()}>Finish and see results</button>}
          {this.link(`/courses/${t.course.id}`, 'Back to the course')}
        </div>
      </section>
    );
  }
}
