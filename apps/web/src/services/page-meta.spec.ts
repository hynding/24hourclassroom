import type { CourseView, PracticeTest, PublicProfile } from '@24hc/shared';
import { applyHead, courseMeta, practiceMeta, resetPageMeta, setPageMeta, summarize, teacherMeta } from './page-meta';
import { isIndexable } from './router';
import { siteStore } from './site-store';

const head = () => document.head;
const content = (selector: string) => head().querySelector(selector)?.getAttribute('content') ?? null;
const jsonLd = () => {
  const script = head().querySelector('script[type="application/ld+json"]');
  return script ? JSON.parse(script.textContent) : null;
};

// mock-doc's history.pushState is a no-op stub; its location takes an href.
function goTo(path: string) {
  window.location.href = `http://testing.stenciljs.com${path}`;
}

const author = { id: 3, name: 'Ms K' };

const course = {
  id: 7, title: 'AP Biology', subject: 'science', grade_level: '9-12', visibility: 'public',
  published_at: null, test_count: 40, material_count: 33, author, description: 'A  full\nyear of biology.',
  created_at: '', updated_at: '', is_author: false, branched_from: null, can_branch: false,
  my_branch_id: null, comment_reactions: false, items: [],
} as CourseView;

describe('page-meta', () => {
  beforeEach(() => {
    head().innerHTML = '<meta name="description" content="static">';
    jest.spyOn(siteStore, 'config', 'get').mockReturnValue({ identity: { name: 'Night School', tagline: 'Lessons after dark' } } as any);
  });

  afterEach(() => jest.restoreAllMocks());

  it('resets a public route to the site name, the tagline and a canonical URL', () => {
    goTo('/library/courses');
    resetPageMeta('/library/courses');

    expect(document.title).toBe('Free courses · Night School');
    expect(content('meta[name="description"]')).toBe('Lessons after dark');
    expect(head().querySelectorAll('meta[name="description"]').length).toBe(1);
    expect(head().querySelector('link[rel="canonical"]').getAttribute('href')).toBe(`${window.location.origin}/library/courses`);
    expect(head().querySelector('meta[name="robots"]')).toBeNull();
  });

  it('marks account and form pages noindex, with no canonical', () => {
    goTo('/courses/7/edit');
    resetPageMeta('/courses/7/edit');

    expect(content('meta[name="robots"]')).toBe('noindex');
    expect(head().querySelector('link[rel="canonical"]')).toBeNull();
  });

  it('describes a loaded course with its own title, Open Graph tags and Course JSON-LD', () => {
    goTo('/courses/7');
    resetPageMeta('/courses/7');
    setPageMeta(courseMeta(course));

    expect(document.title).toBe('AP Biology · Night School');
    expect(content('meta[name="description"]')).toBe('A full year of biology.');
    expect(content('meta[property="og:title"]')).toBe('AP Biology');
    expect(content('meta[property="og:site_name"]')).toBe('Night School');
    expect(jsonLd()).toMatchObject({
      '@context': 'https://schema.org', '@type': 'Course', name: 'AP Biology',
      author: { '@type': 'Person', name: 'Ms K' }, about: 'Science', educationalLevel: '9-12',
    });
  });

  it('keeps an author\'s private course out of the index and drops its JSON-LD', () => {
    goTo('/courses/7');
    setPageMeta(courseMeta({ ...course, visibility: 'private' }));

    expect(content('meta[name="robots"]')).toBe('noindex');
    expect(jsonLd()).toBeNull();
  });

  it('ignores a late load for a page already left', () => {
    goTo('/teachers');
    resetPageMeta('/teachers');
    setPageMeta(courseMeta(course));

    expect(document.title).toBe('Teachers · Night School');
  });

  it('cannot open a non-indexable route to indexing', () => {
    goTo('/courses/7/edit');
    setPageMeta({ path: '/courses/7/edit', title: 'Edit', indexable: true });

    expect(content('meta[name="robots"]')).toBe('noindex');
  });

  it('describes a practice test as a Quiz that is part of its course', () => {
    const test = { id: 9, title: 'Week 1 quiz', subject: 'science', grade_level: '9-12', visibility: 'public', question_count: 12, author, description: null, course: { id: 7, title: 'AP Biology', author } } as PracticeTest;
    goTo('/courses/7/tests/9');
    setPageMeta(practiceMeta(test));

    expect(document.title).toBe('Week 1 quiz (practice) · Night School');
    expect(content('meta[name="description"]')).toBe('Practise 12 questions with answers and explanations, from AP Biology.');
    expect(jsonLd()).toMatchObject({ '@type': 'Quiz', isPartOf: { '@type': 'Course', name: 'AP Biology' } });
  });

  it('indexes only a profile that carries a public profile', () => {
    const nameOnly = { id: 4, name: 'Sam', role: 'student' } as PublicProfile;
    goTo('/teachers/4');
    setPageMeta(teacherMeta(nameOnly));

    expect(content('meta[name="robots"]')).toBe('noindex');
  });

  it('re-renders with a new site name around the current page', () => {
    goTo('/courses/7');
    setPageMeta(courseMeta(course));
    jest.spyOn(siteStore, 'config', 'get').mockReturnValue({ identity: { name: 'Day School', tagline: null } } as any);
    applyHead();

    expect(document.title).toBe('AP Biology · Day School');
  });

  it('summarizes long text at a word boundary', () => {
    expect(summarize(null)).toBeNull();
    expect(summarize('  ')).toBeNull();
    expect(summarize('one two three four', 12)).toBe('one two…');
    expect(summarize('short', 12)).toBe('short');
  });
});

describe('isIndexable', () => {
  it.each(['/', '/library', '/library/tests', '/teachers', '/teachers/3', '/courses/7', '/courses/7/tests/9', '/tests/9', '/materials/2'])('lists %s', (path) => {
    expect(isIndexable(path)).toBe(true);
  });

  it.each(['/login', '/register', '/profile', '/tests', '/tests/new', '/tests/9/edit', '/tests/9/print', '/courses/new', '/courses/7/edit', '/materials/2/share', '/attempts/5', '/nowhere'])('keeps %s out', (path) => {
    expect(isIndexable(path)).toBe(false);
  });
});
