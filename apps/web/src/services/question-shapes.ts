import type { QuestionInput, QuestionType } from '@24hc/shared';

/** Blank answer shape per type -- the only place the client knows the shape table. */
export function blankQuestion(type: QuestionType, from: Partial<QuestionInput> = {}): QuestionInput {
  const base = { type, prompt: from.prompt ?? '', points: from.points ?? 1, ...(from.id ? { id: from.id } : {}), ...(from.explanation !== undefined ? { explanation: from.explanation } : {}) };
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
  }
}
