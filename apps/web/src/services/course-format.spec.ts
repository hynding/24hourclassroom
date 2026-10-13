import type { CourseItem } from '@24hc/shared';
import { courseItemKind, courseItemTitle, courseSections } from './course-format';

const test = (id: number, section: string | null): CourseItem => ({
  id, position: id, section, kind: 'test', test: { id, title: `T${id}`, visibility: 'public', question_count: 1 },
});
const material = (id: number, name: string): CourseItem => ({
  id, position: id, section: null, kind: 'material',
  material: { id, title: `M${id}`, visibility: 'public', original_name: name, mime_type: 'text/plain', size_bytes: 10, author: { id: 1, name: 'Ms K' } },
});

describe('courseSections', () => {
  it('groups consecutive items under one heading and keeps a repeated heading further down separate', () => {
    const groups = courseSections([test(1, 'Unit 1'), test(2, 'Unit 1'), test(3, 'Unit 2'), test(4, null), test(5, 'Unit 1')]);
    expect(groups.map((g) => [g.title, g.items.map((i) => i.id)])).toEqual([
      ['Unit 1', [1, 2]],
      ['Unit 2', [3]],
      [null, [4]],
      ['Unit 1', [5]],
    ]);
  });

  it('treats an empty heading as no heading', () => {
    expect(courseSections([test(1, ''), test(2, null)]).map((g) => g.title)).toEqual([null]);
    expect(courseSections([])).toEqual([]);
  });
});

describe('courseItemTitle', () => {
  it('drops the course name prefix and nothing else', () => {
    expect(courseItemTitle('AP Biology', 'AP Biology · Week 07 · Quiz · Cells')).toBe('Week 07 · Quiz · Cells');
    expect(courseItemTitle('AP Biology', 'AP Biology Lab Notes')).toBe('AP Biology Lab Notes');
    expect(courseItemTitle('AP Biology', 'Cells')).toBe('Cells');
    expect(courseItemTitle('AP Biology', 'AP Biology · ')).toBe('AP Biology · ');
  });
});

describe('courseItemKind', () => {
  it('names tests, flashcard decks, and other files by type', () => {
    expect(courseItemKind(test(1, null))).toBe('Test');
    expect(courseItemKind(material(2, 'week-01.flashcards.md'))).toBe('Flashcards');
    expect(courseItemKind(material(3, 'guide.md'))).toBe('Reading');
    expect(courseItemKind(material(4, 'notes.TXT'))).toBe('Reading');
    expect(courseItemKind(material(5, 'worksheet.pdf'))).toBe('PDF');
  });
});
