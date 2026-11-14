import type { NavIcon } from './nav-icons';

export interface LibrarySection {
  path: string;
  title: string;
  description: string;
  icon: NavIcon;
}

/**
 * The library's three shelves, in one place: the side panel lists them under
 * Library, the /library index renders them as cards, and page-library's
 * segment links walk the same list. All three are public.
 */
export const LIBRARY_SECTIONS: LibrarySection[] = [
  {
    path: '/library/tests',
    title: 'Tests',
    description: 'Quizzes, unit exams and practice tests teachers have published. Take one, or print it for class.',
    icon: 'tests',
  },
  {
    path: '/library/materials',
    title: 'Materials',
    description: 'Lesson plans, worksheets, study guides and flashcard decks, ready to read or download.',
    icon: 'materials',
  },
  {
    path: '/library/courses',
    title: 'Courses',
    description: 'Whole courses that bundle tests and materials in order, with a practice mode that reveals answers.',
    icon: 'courses',
  },
];
