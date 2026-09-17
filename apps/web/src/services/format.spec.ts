import { formatDueDate } from './format';

describe('formatDueDate', () => {
  it('reads the calendar date as UTC, regardless of the runner\'s zone', () => {
    const result = formatDueDate('2026-10-01T00:00:00.000000Z');
    expect(result).toContain('2026');
    expect(result).toMatch(/\b1\b/);
  });

  it('formats a date-only string (no time component) the same way', () => {
    const result = formatDueDate('2026-10-01');
    expect(result).toContain('2026');
    expect(result).toMatch(/\b1\b/);
  });
});
