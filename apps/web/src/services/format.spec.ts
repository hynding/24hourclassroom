import { fileTypeLabel, formatBytes, formatCents, formatDueDate } from './format';
import { GENERATION_BUDGET_CENTS, MAX_MATERIAL_BYTES } from '@24hc/shared';

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

describe('formatBytes', () => {
  it('labels binary units KB and MB with one decimal', () => {
    expect(formatBytes(0)).toBe('0 B');
    expect(formatBytes(512)).toBe('512 B');
    expect(formatBytes(1024)).toBe('1 KB');
    expect(formatBytes(1536)).toBe('1.5 KB');
    expect(formatBytes(1048576)).toBe('1 MB');
    expect(formatBytes(1258291)).toBe('1.2 MB');
  });

  it('renders the shared upload cap exactly as the server message does', () => {
    // The server's 422 says "Choose a file under 10 MB." and the two strings
    // sit next to each other in the form. Decimal (10^3) units would render
    // the same cap as "10.5 MB" and make them disagree.
    expect(formatBytes(MAX_MATERIAL_BYTES)).toBe('10 MB');
  });
});

describe('fileTypeLabel', () => {
  it('reads the extension off the client filename and upper-cases it', () => {
    expect(fileTypeLabel('worksheet.pdf')).toBe('PDF');
    expect(fileTypeLabel('Notes.DOCX')).toBe('DOCX');
    expect(fileTypeLabel('archive.tar.gz')).toBe('GZ');
  });

  it('falls back to a generic label when there is no usable extension', () => {
    // mime_type is server-detected but unreadable to a human
    // ("application/vnd.oasis.opendocument.text"), so the cells use this.
    expect(fileTypeLabel('README')).toBe('File');
    expect(fileTypeLabel('.hidden')).toBe('File');
    expect(fileTypeLabel('')).toBe('File');
  });
});

describe('formatCents', () => {
  it('renders an integer number of cents as a dollar amount', () => {
    // Anthropic reports list cost as an integer string of cents and the
    // server casts it to an int, so nothing here parses a decimal.
    expect(formatCents(0)).toBe('$0.00');
    expect(formatCents(5)).toBe('$0.05');
    expect(formatCents(123)).toBe('$1.23');
    expect(formatCents(12345)).toBe('$123.45');
  });

  it('renders the shared budget literal the way the server message does', () => {
    // GenerationMessages::budget() composes "Stopped at the $2.00 budget..."
    // from config('generation.budget_cents'), which is mirrored to
    // GENERATION_BUDGET_CENTS -- the two strings must not disagree.
    expect(formatCents(GENERATION_BUDGET_CENTS)).toBe('$2.00');
  });
});
