import { Component, Event, EventEmitter, h, Prop } from '@stencil/core';
import { BLANK_MARKER, QUESTION_TYPES, QuestionInput, QuestionType } from '@24hc/shared';
import { blankQuestion } from '../../services/question-shapes';
import { assertNever } from '../../services/assert-never';

const MAX_ACCEPTED_ANSWERS = 10;

@Component({ tag: 'test-question-editor', styleUrl: 'test-question-editor.css', shadow: true })
export class TestQuestionEditor {
  @Prop({ mutable: true }) question: QuestionInput;
  @Prop() index = 0;
  @Prop() error?: string;
  /** The previous question's stimulus, offered as a one-click copy so a set shares it verbatim. */
  @Prop() previousStimulus?: string | null;

  @Event() questionChange: EventEmitter<QuestionInput>;
  @Event() questionRemove: EventEmitter<void>;
  @Event() questionMove: EventEmitter<-1 | 1>;

  /**
   * Keeps a local copy in sync in addition to emitting: the parent is the
   * source of truth (its next render passes a fresh `question` prop that
   * overwrites this), but several edits can fire synchronously between two
   * parent renders -- e.g. two toggleCorrect() calls in the same tick --
   * and each must see the previous edit's result, not stale data.
   */
  private emit(next: QuestionInput) {
    this.question = next;
    this.questionChange.emit(next);
  }

  setType(type: QuestionType) {
    this.emit(blankQuestion(type, this.question));
  }

  setOption(i: number, text: string) {
    const options = [...(this.question.options ?? [])];
    options[i] = text;
    this.emit({ ...this.question, options });
  }

  addOption() {
    const options = [...(this.question.options ?? []), ''];
    const { option_explanations, ...rest } = this.question;
    this.emit({ ...rest, options, ...this.rationalesFor(options.length, (r) => [...r, '']) });
  }

  removeOption(i: number) {
    const options = (this.question.options ?? []).filter((_, j) => j !== i);
    const answer = Array.isArray(this.question.answer)
      ? (this.question.answer as number[]).filter((a) => a !== i).map((a) => (a > i ? a - 1 : a))
      : Math.max(0, Math.min((this.question.answer as number) > i ? (this.question.answer as number) - 1 : (this.question.answer as number), options.length - 1));
    const { option_explanations, ...rest } = this.question;
    this.emit({ ...rest, options, answer, ...this.rationalesFor(options.length, (r) => r.filter((_, j) => j !== i)) });
  }

  toggleCorrect(i: number) {
    const current = (this.question.answer as number[]) ?? [];
    const answer = current.includes(i) ? current.filter((a) => a !== i) : [...current, i].sort((a, b) => a - b);
    this.emit({ ...this.question, answer });
  }

  /** The rationale list padded to one entry per option, so edits stay parallel. */
  private rationales(): string[] {
    const list = this.question.option_explanations ?? [];
    return (this.question.options ?? []).map((_, i) => list[i] ?? '');
  }

  /**
   * `option_explanations` must have exactly one entry per option when
   * present, and is omitted entirely when every entry is blank so a test
   * written before rationales existed round-trips byte-for-byte.
   */
  private rationalesFor(length: number, mutate: (current: string[]) => string[]): Pick<QuestionInput, 'option_explanations'> {
    if (!this.question.option_explanations) {
      return {};
    }
    const next = mutate(this.rationales()).slice(0, length);
    while (next.length < length) {
      next.push('');
    }
    return next.some((r) => r !== '') ? { option_explanations: next } : {};
  }

  setRationale(i: number, text: string) {
    const list = this.rationales();
    list[i] = text;
    const { option_explanations, ...rest } = this.question;
    this.emit(list.some((r) => r !== '') ? { ...rest, option_explanations: list } : rest);
  }

  private accepted(): string[] {
    return Array.isArray(this.question.answer) ? (this.question.answer as string[]) : [''];
  }

  setAccepted(i: number, text: string) {
    const answer = [...this.accepted()];
    answer[i] = text;
    this.emit({ ...this.question, answer });
  }

  addAccepted() {
    if (this.accepted().length >= MAX_ACCEPTED_ANSWERS) {
      return;
    }
    this.emit({ ...this.question, answer: [...this.accepted(), ''] });
  }

  removeAccepted(i: number) {
    const answer = this.accepted().filter((_, j) => j !== i);
    this.emit({ ...this.question, answer: answer.length ? answer : [''] });
  }

  private set<K extends keyof QuestionInput>(key: K, value: QuestionInput[K]) {
    this.emit({ ...this.question, [key]: value });
  }

  private renderOptions() {
    const q = this.question;
    const multi = q.type === 'multi_select';
    const rationales = this.rationales();
    return (
      <fieldset>
        <legend>Options (mark the correct {multi ? 'ones' : 'one'})</legend>
        {(q.options ?? []).map((opt, i) => (
          <div class="option-row">
            <div class="option">
              <input
                type={multi ? 'checkbox' : 'radio'}
                name={`correct-${this.index}`}
                checked={multi ? (q.answer as number[]).includes(i) : q.answer === i}
                onChange={() => (multi ? this.toggleCorrect(i) : this.set('answer', i))}
                aria-label={`Option ${i + 1} is correct`}
              />
              <input type="text" value={opt} placeholder={`Option ${i + 1}`} onInput={(e) => this.setOption(i, (e.target as HTMLInputElement).value)} />
              <button type="button" class="btn" disabled={(q.options ?? []).length <= 2} onClick={() => this.removeOption(i)}>Remove</button>
            </div>
            <textarea
              class="rationale"
              rows={2}
              value={rationales[i]}
              placeholder="Why this option is right or wrong"
              aria-label={`Why option ${i + 1} is right or wrong`}
              onInput={(e) => this.setRationale(i, (e.target as HTMLTextAreaElement).value)}
            ></textarea>
          </div>
        ))}
        <button type="button" class="btn" disabled={(q.options ?? []).length >= 8} onClick={() => this.addOption()}>Add option</button>
        {multi && (
          <label class="inline">
            <input type="checkbox" checked={q.partial_credit ?? false} onChange={(e) => this.set('partial_credit', (e.target as HTMLInputElement).checked)} />
            Partial credit
          </label>
        )}
      </fieldset>
    );
  }

  private renderBlanks() {
    const q = this.question;
    const accepted = this.accepted();
    return (
      <fieldset class="blanks">
        <legend>Accepted answers (the first is the one students see as correct)</legend>
        <p class="hint">The prompt must contain {BLANK_MARKER} where the blank goes.</p>
        {accepted.map((text, i) => (
          <div class="option">
            <input type="text" maxlength="100" value={text} placeholder={`Accepted answer ${i + 1}`} aria-label={`Accepted answer ${i + 1}`} onInput={(e) => this.setAccepted(i, (e.target as HTMLInputElement).value)} />
            <button type="button" class="btn" disabled={accepted.length <= 1} onClick={() => this.removeAccepted(i)}>Remove</button>
          </div>
        ))}
        <button type="button" class="btn" disabled={accepted.length >= MAX_ACCEPTED_ANSWERS} onClick={() => this.addAccepted()}>Add accepted answer</button>
        <label class="inline">
          <input type="checkbox" checked={q.auto_grade ?? true} onChange={(e) => this.set('auto_grade', (e.target as HTMLInputElement).checked)} />
          Grade automatically
        </label>
      </fieldset>
    );
  }

  private renderAnswer() {
    const q = this.question;
    switch (q.type) {
      case 'multiple_choice':
      case 'multi_select':
        return this.renderOptions();
      case 'true_false':
        return (
          <label>
            Correct answer
            <select onInput={(e) => this.set('answer', (e.target as HTMLSelectElement).value === 'true')}>
              <option value="true" selected={q.answer === true}>True</option>
              <option value="false" selected={q.answer === false}>False</option>
            </select>
          </label>
        );
      case 'short_answer':
        return (
          <label>
            Expected answer (shown to you when grading)
            <input type="text" value={q.answer as string} onInput={(e) => this.set('answer', (e.target as HTMLInputElement).value)} />
          </label>
        );
      case 'numeric': {
        const a = q.answer as { value: number; tolerance?: number };
        return (
          <div class="numeric">
            <label>
              Value
              <input type="number" step="any" value={a.value} onInput={(e) => this.set('answer', { ...a, value: Number((e.target as HTMLInputElement).value) })} />
            </label>
            <label>
              Tolerance (±)
              <input type="number" step="any" min="0" value={a.tolerance ?? 0} onInput={(e) => this.set('answer', { ...a, tolerance: Number((e.target as HTMLInputElement).value) })} />
            </label>
          </div>
        );
      }
      case 'fill_blank':
        return this.renderBlanks();
      case 'long_answer':
        return (
          <label>
            Model answer (shown to you when grading)
            <textarea class="model-answer" rows={4} value={(q.answer as string) ?? ''} onInput={(e) => this.set('answer', (e.target as HTMLTextAreaElement).value)}></textarea>
          </label>
        );
      default:
        return assertNever(q.type, 'question type');
    }
  }

  render() {
    const q = this.question;
    if (!q) {
      return null;
    }
    // Only long_answer is range-limited (4-10, server-validated).
    const longAnswer = q.type === 'long_answer';
    return (
      <div class="question">
        <div class="head">
          <strong>Question {this.index + 1}</strong>
          <button type="button" class="btn" onClick={() => this.questionMove.emit(-1)} aria-label="Move up">↑</button>
          <button type="button" class="btn" onClick={() => this.questionMove.emit(1)} aria-label="Move down">↓</button>
          <button type="button" class="btn" onClick={() => this.questionRemove.emit()}>Remove</button>
        </div>
        {this.error && <p class="error">{this.error}</p>}
        <label>
          Type
          <select onInput={(e) => this.setType((e.target as HTMLSelectElement).value as QuestionType)}>
            {QUESTION_TYPES.map((t) => <option value={t.value} selected={t.value === q.type}>{t.label}</option>)}
          </select>
        </label>
        <label>
          Stimulus (shared passage or data, optional)
          <textarea class="stimulus" rows={4} value={q.stimulus ?? ''} onInput={(e) => this.set('stimulus', (e.target as HTMLTextAreaElement).value || null)}></textarea>
        </label>
        {this.previousStimulus && (
          <button type="button" class="btn copy-stimulus" onClick={() => this.set('stimulus', this.previousStimulus)}>Copy stimulus from previous question</button>
        )}
        <label>
          Prompt
          <textarea value={q.prompt} onInput={(e) => this.set('prompt', (e.target as HTMLTextAreaElement).value)}></textarea>
        </label>
        {this.renderAnswer()}
        <label>
          Points
          <input type="number" min={longAnswer ? 4 : 1} max={longAnswer ? 10 : 100} value={q.points ?? 1} onInput={(e) => this.set('points', Number((e.target as HTMLInputElement).value))} />
        </label>
        <label>
          Explanation (shown after submitting)
          <textarea value={q.explanation ?? ''} onInput={(e) => this.set('explanation', (e.target as HTMLTextAreaElement).value || null)}></textarea>
        </label>
      </div>
    );
  }
}
