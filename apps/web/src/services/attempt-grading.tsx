import { FunctionalComponent, h } from '@stencil/core';
import { Attempt, AttemptQuestion, MANUAL_GRADE_TYPES } from '@24hc/shared';
import { formatAnswer, formatResponse, isTextResponse, showsStimulus } from './question-format';

interface Props {
  attempt: Attempt;
  busy: boolean;
  onGrade: (attemptId: number, answerId: number, awarded: number) => void;
}

function renderResponse(q: AttemptQuestion) {
  if (isTextResponse(q.type)) {
    return [<p>Response:</p>, <p class="response">{formatResponse(q, q.response)}</p>];
  }
  return <p>Response: <strong>{formatResponse(q, q.response)}</strong></p>;
}

/**
 * Hand grading for every type the server lets a grader override; for a
 * fill_blank that replaces the automatic score. The explanation sits beside
 * the form because it is what the grader marks against.
 */
function renderGrading(attempt: Attempt, q: AttemptQuestion, busy: boolean, onGrade: Props['onGrade']) {
  if (!MANUAL_GRADE_TYPES.includes(q.type) || !q.answer_id) {
    return null;
  }
  return (
    <div class="grading">
      <form class="grade" onSubmit={(e) => {
        e.preventDefault();
        const input = (e.target as HTMLFormElement).querySelector('input') as HTMLInputElement;
        onGrade(attempt.id, q.answer_id, Number(input.value));
      }}>
        <label>
          Points
          <input type="number" step="0.25" min="0" max={q.graded_answer?.points ?? q.points} value={q.awarded ?? ''} />
        </label>
        <button type="submit" class="btn" disabled={busy}>Save grade</button>
      </form>
      {q.explanation && (
        <div class="accept">
          <h4>What to accept</h4>
          <rich-text text={q.explanation}></rich-text>
        </div>
      )}
    </div>
  );
}

/**
 * One attempt's answers with the grading form under each hand-gradable one,
 * shared by the test's results page and the grading queue. The host page's
 * stylesheet carries the `.answers`/`.grading` rules (shadow DOM).
 */
export const GradedAnswers: FunctionalComponent<Props> = ({ attempt, busy, onGrade }) => {
  // An unsubmitted attempt carries no `answer`/`graded_answer`/`awarded`,
  // so the answers list rendered a literal "Expected: undefined". There is
  // nothing to grade until the student submits -- say so instead.
  if (!attempt.submitted_at) {
    return <p class="meta">In progress — not yet submitted.</p>;
  }
  return (
    <ol class="answers">
      {attempt.questions.map((q, i) => (
        <li>
          {showsStimulus(attempt.questions, i) && <div class="stimulus"><rich-text text={q.stimulus}></rich-text></div>}
          <div class="prompt"><rich-text text={q.prompt}></rich-text></div>
          {renderResponse(q)}
          <p class="meta">Expected: {formatAnswer(q, q.graded_answer?.answer ?? q.answer)} · {q.awarded ?? '—'} / {q.graded_answer?.points ?? q.points}</p>
          {renderGrading(attempt, q, busy, onGrade)}
        </li>
      ))}
    </ol>
  );
};
