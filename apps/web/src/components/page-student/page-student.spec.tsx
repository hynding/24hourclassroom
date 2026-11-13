import { h } from '@stencil/core';
import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const studentAssignments = jest.fn();
const recoverFromExpiredSession = jest.fn();

jest.mock('../../services/tests-store', () => ({
  testsStore: { studentAssignments: (...a: unknown[]) => studentAssignments(...a) },
}));

jest.mock('../../services/session-recovery', () => ({
  recoverFromExpiredSession: (...a: unknown[]) => recoverFromExpiredSession(...a),
}));

const me: { value: { id: number; role: string } | null } = { value: null };
jest.mock('../../services/auth-store', () => ({ authStore: { get currentUser() { return me.value; } } }));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));

// Imported after jest.mock(): Stencil transpiles with ts.transpileModule.
import { PageStudent } from './page-student';

const summary = (score: string) => ({
  id: 1, test_id: 1, assignment_id: 1, started_at: '2026-10-01', submitted_at: '2026-10-01',
  score, max_score: '2.00', graded_at: null, ungraded_count: 0,
});

describe('page-student', () => {
  beforeEach(() => {
    studentAssignments.mockReset();
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
  });

  const mount = (id?: number) =>
    newSpecPage({
      components: [PageStudent],
      template: () => <page-student studentId={id}></page-student>,
    });

  it('lists the student\'s assignments with scores, titles as plain text', async () => {
    studentAssignments.mockResolvedValue({
      student: { id: 40, name: 'Sam' },
      data: [
        { id: 1, due_at: null, test: { id: 9, title: 'Cells quiz', subject: 'science', grade_level: '9-12', question_count: 2, author: { id: 2, name: 'Ms A' } }, latest: summary('1.00'), best: summary('1.00') },
        { id: 2, due_at: null, test: { id: 10, title: 'Essay', subject: 'science', grade_level: '9-12', question_count: 1, author: { id: 3, name: 'Mr B' } }, latest: null, best: null },
      ],
    });

    const page = await mount(40);
    const text = page.root.shadowRoot.textContent;

    expect(studentAssignments).toHaveBeenCalledWith(40);
    expect(text).toContain('Sam');
    expect(text).toContain('Cells quiz');
    expect(text).toContain('Latest 1.00 / 2.00');
    expect(text).toContain('Not submitted yet');
    expect(page.root.shadowRoot.querySelector('a')).toBeNull();
  });

  it('links a parent or guardian to each submitted attempt\'s answers, and nobody else', async () => {
    const data = {
      student: { id: 40, name: 'Sam' },
      data: [{ id: 1, due_at: null, test: { id: 9, title: 'Cells quiz', subject: 'science', grade_level: '9-12', question_count: 2, author: { id: 2, name: 'Ms A' } }, latest: { ...summary('1.00'), id: 5 }, best: { ...summary('2.00'), id: 6 } }],
    };
    for (const [role, expected] of [['guardian', true], ['tutor', false], ['assistant', false]] as const) {
      studentAssignments.mockResolvedValue(data);
      me.value = { id: 99, role };
      const page = await mount(40);
      const hrefs = Array.from(page.root.shadowRoot.querySelectorAll('a')).map((a) => a.getAttribute('href'));
      expect(hrefs).toEqual(expected ? ['/attempts/5', '/attempts/6'] : []);
    }
    me.value = null;
  });

  it('shows not found on a 404', async () => {
    studentAssignments.mockRejectedValue(new ApiError(404, 'Not Found'));
    const page = await mount(40);

    expect(page.root.shadowRoot.textContent).toContain('Not found');
  });

  it('shows not found without calling the API when the id is missing', async () => {
    const page = await mount(undefined);

    expect(studentAssignments).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('Not found');
  });
});
