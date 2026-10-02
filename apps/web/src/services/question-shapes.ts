import type { QuestionInput, QuestionType } from '@24hc/shared';
import { assertNever } from './assert-never';

/** `long_answer` points are server-validated to this range. */
const LONG_ANSWER_POINTS = { min: 4, max: 10, default: 6 };

/** Blank answer shape per type -- the only place the client knows the shape table. */
export function blankQuestion(type: QuestionType, from: Partial<QuestionInput> = {}): QuestionInput {
  // `stimulus` survives a type switch: it belongs to the set of questions,
  // not to the answer shape. Empty stays absent so old tests round-trip.
  const base = {
    type,
    prompt: from.prompt ?? '',
    points: from.points ?? 1,
    ...(from.id ? { id: from.id } : {}),
    ...(from.stimulus ? { stimulus: from.stimulus } : {}),
    ...(from.explanation !== undefined ? { explanation: from.explanation } : {}),
  };
  switch (type) {
    case 'multiple_choice':
      return { ...base, options: ['', ''], answer: 0 };
    case 'multi_select':
      return { ...base, options: ['', ''], answer: [], partial_credit: false };
    case 'true_false':
      return { ...base, answer: true };
    case 'short_answer':
      return { ...base, answer: '' };
    case 'numeric':
      return { ...base, answer: { value: 0, tolerance: 0 } };
    case 'fill_blank':
      return { ...base, answer: [''], auto_grade: true };
    case 'long_answer': {
      const inRange = base.points >= LONG_ANSWER_POINTS.min && base.points <= LONG_ANSWER_POINTS.max;
      return { ...base, answer: '', points: inRange ? base.points : LONG_ANSWER_POINTS.default };
    }
    default:
      return assertNever(type, 'question type');
  }
}
