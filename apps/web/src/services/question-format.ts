import type { Question, QuestionType } from '@24hc/shared';
import { assertNever } from './assert-never';

/**
 * The one place a question's answer or a student's response becomes text.
 * Every switch here is exhaustive: a new `QuestionType` that reaches one of
 * these without an arm is a compile error, not a blank line on a page.
 */

type Numeric = { value: number; tolerance?: number };

/** A, B, C … as printed beside an option. */
export function letter(i: number): string {
  return String.fromCharCode(65 + i);
}

/** Whether option `i` is among `value` (a single index or a list of them). */
export function optionChosen(value: unknown, i: number): boolean {
  return Array.isArray(value) ? value.includes(i) : value === i;
}

function optionLabels(q: Question, value: unknown): string {
  if (typeof value === 'number') {
    return q.options?.[value] ?? String(value);
  }
  if (Array.isArray(value)) {
    return value.map((i: number) => q.options?.[i] ?? String(i)).join(', ');
  }
  return String(value);
}

function optionLetters(value: unknown): string {
  if (typeof value === 'number') {
    return letter(value);
  }
  if (Array.isArray(value)) {
    return value.map((i: number) => letter(i)).join(', ');
  }
  return String(value);
}

function numericText(value: unknown): string {
  if (value && typeof value === 'object') {
    const a = value as Numeric;
    return a.tolerance ? `${a.value} ± ${a.tolerance}` : String(a.value);
  }
  return String(value);
}

function trueFalse(value: unknown): string {
  return value === true ? 'True' : value === false ? 'False' : String(value);
}

/** What the student put down, as a sentence fragment. */
export function formatResponse(q: Question, value: unknown): string {
  if (value === null || value === undefined) {
    return '(skipped)';
  }
  switch (q.type) {
    case 'multiple_choice':
    case 'multi_select':
      return optionLabels(q, value);
    case 'true_false':
      return trueFalse(value);
    case 'numeric':
      return numericText(value);
    case 'short_answer':
    case 'fill_blank':
    case 'long_answer':
      return String(value);
    default:
      return assertNever(q.type, 'question type');
  }
}

/** The correct answer, spelled out (option text, not letters). */
export function formatAnswer(q: Question, answer: unknown): string {
  if (answer === null || answer === undefined) {
    return '';
  }
  switch (q.type) {
    case 'multiple_choice':
    case 'multi_select':
      return optionLabels(q, answer);
    case 'true_false':
      return trueFalse(answer);
    case 'numeric':
      return numericText(answer);
    case 'fill_blank':
      return Array.isArray(answer) ? answer.map(String).join(' / ') : String(answer);
    case 'short_answer':
    case 'long_answer':
      return String(answer);
    default:
      return assertNever(q.type, 'question type');
  }
}

/** The printed answer key: letters for option types, the canonical accepted answer for a blank. */
export function keyFor(q: Question, answer: unknown): string {
  if (answer === null || answer === undefined) {
    return '';
  }
  switch (q.type) {
    case 'multiple_choice':
    case 'multi_select':
      return optionLetters(answer);
    case 'true_false':
      return trueFalse(answer);
    case 'numeric':
      return numericText(answer);
    case 'fill_blank':
      return Array.isArray(answer) ? String(answer[0] ?? '') : String(answer);
    case 'short_answer':
    case 'long_answer':
      return String(answer);
    default:
      return assertNever(q.type, 'question type');
  }
}

/** Types whose response is prose the student typed, shown pre-wrapped. */
export function isTextResponse(type: QuestionType): boolean {
  switch (type) {
    case 'short_answer':
    case 'fill_blank':
    case 'long_answer':
      return true;
    case 'multiple_choice':
    case 'multi_select':
    case 'true_false':
    case 'numeric':
      return false;
    default:
      return assertNever(type, 'question type');
  }
}

/**
 * A stimulus is repeated verbatim on every question of its set, so a page
 * shows it once: before question `i` only when it is non-empty and differs
 * from the previous question's.
 */
export function showsStimulus(questions: { stimulus?: string | null }[], i: number): boolean {
  const stimulus = questions[i]?.stimulus;
  if (!stimulus) {
    return false;
  }
  return stimulus !== questions[i - 1]?.stimulus;
}
