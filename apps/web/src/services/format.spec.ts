import { fileTypeLabel, formatBytes, formatDueDate } from './format';
import { MAX_MATERIAL_BYTES } from '@24hc/shared';

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
