import { csvCell, csvFileName, toCsv } from './csv';

describe('csv', () => {
  it('writes numbers bare and nulls empty', () => {
    expect(csvCell(8.5)).toBe('8.5');
    expect(csvCell(0)).toBe('0');
    expect(csvCell(null)).toBe('');
    expect(csvCell(NaN)).toBe('');
  });

  it('quotes commas, quotes and line breaks', () => {
    expect(csvCell('Lee, Ada')).toBe('"Lee, Ada"');
    expect(csvCell('Ada "Ace" Lee')).toBe('"Ada ""Ace"" Lee"');
    expect(csvCell('two\nlines')).toBe('"two\nlines"');
    expect(csvCell('Plain')).toBe('Plain');
  });

  it('defuses text a spreadsheet would run as a formula', () => {
    expect(csvCell('=HYPERLINK("x")')).toBe('"\'=HYPERLINK(""x"")"');
    expect(csvCell('+1')).toBe("'+1");
    expect(csvCell('-2')).toBe("'-2");
    expect(csvCell('@SUM')).toBe("'@SUM");
  });

  it('joins a gradebook into CRLF lines behind a byte-order mark', () => {
    const text = toCsv({ title: 'Quiz', columns: ['Student', 'Score'], rows: [['Zoë', 9], ['Bo', null]] });
    expect(text).toBe('﻿Student,Score\r\nZoë,9\r\nBo,\r\n');
  });

  it('names the file after the title and the date', () => {
    expect(csvFileName('AP Biology · Week 01 · Quiz: Água', new Date(2026, 10, 18))).toBe('ap-biology-week-01-quiz-agua-scores-2026-11-18.csv');
    expect(csvFileName('···', new Date(2026, 0, 2))).toBe('gradebook-scores-2026-01-02.csv');
  });
});
