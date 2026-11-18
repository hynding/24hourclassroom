import type { MyAssignment } from '@24hc/shared';
import { localDay, upNext } from './up-next';

const attempt = (submitted_at: string | null) => ({
  id: 1, test_id: 1, assignment_id: 1, started_at: '2026-11-01T10:00:00Z', submitted_at, score: '8.00', max_score: '10.00', graded_at: null, ungraded_count: 0,
});
const a = (id: number, due_at: string | null, submitted_at: string | null | undefined = undefined): MyAssignment => ({
  id, due_at,
  test: { id, title: `Quiz ${id}`, subject: 'science', grade_level: '9-12', question_count: 10, author: { id: 1, name: 'Ms K' } },
  latest: submitted_at === undefined ? null : attempt(submitted_at),
  best: submitted_at ? attempt(submitted_at) : null,
} as MyAssignment);

// Wednesday 18 November 2026, mid-morning local time.
const now = new Date(2026, 10, 18, 10, 0, 0);

describe('upNext', () => {
  it('reads the local calendar day', () => {
    expect(localDay(now)).toBe('2026-11-18');
    expect(localDay(new Date(2026, 0, 5, 23, 59))).toBe('2026-01-05');
  });

  it('splits open work into overdue, this week and later', () => {
    const list = [
      a(1, '2026-11-10T00:00:00.000000Z'),
      a(2, '2026-11-17T00:00:00.000000Z'),
      a(3, '2026-11-18T00:00:00.000000Z'),
      a(4, '2026-11-24T00:00:00.000000Z'),
      a(5, '2026-11-25T00:00:00.000000Z'),
      a(6, null),
    ];
    const u = upNext(list, now);

    expect(u.overdue.map((x) => x.id)).toEqual([1, 2]);
    expect(u.thisWeek.map((x) => x.id)).toEqual([3, 4]);
    expect(u.laterCount).toBe(2);
  });

  it('treats a started but unsubmitted attempt as open, and a submitted one as done', () => {
    const u = upNext([a(1, '2026-11-10T00:00:00Z', null), a(2, '2026-11-10T00:00:00Z', '2026-11-12T09:00:00Z')], now);
    expect(u.overdue.map((x) => x.id)).toEqual([1]);
    expect(u.recent.map((x) => x.id)).toEqual([2]);
  });

  it('lists the last fortnight\'s submissions newest first', () => {
    const u = upNext([
      a(1, null, '2026-11-01T09:00:00Z'),
      a(2, null, '2026-11-10T09:00:00Z'),
      a(3, null, '2026-11-17T09:00:00Z'),
    ], now);
    expect(u.recent.map((x) => x.id)).toEqual([3, 2]);
    expect(u.laterCount).toBe(0);
  });
});
