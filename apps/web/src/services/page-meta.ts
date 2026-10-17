import { GRADE_LEVELS, SUBJECTS } from '@24hc/shared';
import type { CourseView, MaterialView, PracticeTest, PublicProfile, TestView } from '@24hc/shared';
import { isIndexable } from './router';
import { siteStore } from './site-store';

/**
 * What search engines and link previews read about the current page: its
 * title, description, canonical URL, Open Graph tags and JSON-LD.
 *
 * app-root resets it on every navigation (site-name title, indexable by
 * route); a page that loads a course, test, material or profile then
 * describes it. Every write goes through applyHead(), the one writer of
 * document.title and of the tags marked `data-page-meta`.
 *
 * The SPA renders these after load, so they reach crawlers that run
 * JavaScript (Google, Bing); preview bots that don't still see index.html.
 */
export interface PageMeta {
  /** The path this describes. A late load for a page already left is dropped. */
  path: string;
  /** The page's own title; the site name is appended. None: the site name alone. */
  title?: string;
  description?: string | null;
  indexable: boolean;
  type?: 'website' | 'article' | 'profile';
  jsonLd?: Record<string, unknown>;
}

const DESCRIPTION_MAX = 160;
const JSON_LD_ID = 'page-json-ld';

let current: PageMeta | null = null;

/** Listing pages need no load to describe, so the reset names them. */
const LISTING_TITLES: Record<string, string> = {
  '/library': 'Library',
  '/library/courses': 'Free courses',
  '/library/tests': 'Practice tests',
  '/library/materials': 'Study materials',
  '/teachers': 'Teachers',
};

export function resetPageMeta(path: string): void {
  current = { path, title: LISTING_TITLES[path], indexable: isIndexable(path) };
  applyHead();
}

export function setPageMeta(meta: PageMeta): void {
  if (meta.path !== window.location.pathname) {
    return;
  }
  // A page can only narrow what its route allows, never open a form or
  // private route to indexing.
  current = { ...meta, indexable: meta.indexable && isIndexable(meta.path) };
  applyHead();
}

/** Whitespace collapsed, cut at a word boundary with an ellipsis. */
export function summarize(text: string | null | undefined, max = DESCRIPTION_MAX): string | null {
  const flat = (text ?? '').replace(/\s+/g, ' ').trim();
  if (flat === '') {
    return null;
  }
  if (flat.length <= max) {
    return flat;
  }
  const cut = flat.slice(0, max - 1);
  const space = cut.lastIndexOf(' ');
  return `${(space > max / 2 ? cut.slice(0, space) : cut).replace(/[\s.,;:]+$/, '')}…`;
}

export function applyHead(): void {
  const site = siteStore.config.identity;
  const meta = current ?? { path: window.location.pathname, indexable: isIndexable(window.location.pathname) };
  const title = meta.title ? `${meta.title} · ${site.name}` : site.name;
  const description = summarize(meta.description) ?? summarize(site.tagline);
  const url = `${window.location.origin}${meta.path}`;

  document.title = title;
  setTag('meta', 'name', 'description', description);
  setTag('meta', 'name', 'robots', meta.indexable ? null : 'noindex');
  setTag('link', 'rel', 'canonical', meta.indexable ? url : null);
  setTag('meta', 'property', 'og:title', meta.title ?? site.name);
  setTag('meta', 'property', 'og:description', description);
  setTag('meta', 'property', 'og:type', meta.type ?? 'website');
  setTag('meta', 'property', 'og:url', url);
  setTag('meta', 'property', 'og:site_name', site.name);
  setTag('meta', 'name', 'twitter:card', 'summary');

  document.getElementById(JSON_LD_ID)?.remove();
  if (meta.jsonLd && meta.indexable) {
    const script = document.createElement('script');
    script.id = JSON_LD_ID;
    script.type = 'application/ld+json';
    // textContent, never innerHTML: the JSON is author-written text.
    script.textContent = JSON.stringify({ '@context': 'https://schema.org', ...meta.jsonLd });
    document.head.appendChild(script);
  }
}

/**
 * Upserts `<meta name=…>` / `<meta property=…>` / `<link rel=…>` keyed by
 * that attribute; null removes it. index.html's static description is
 * adopted rather than duplicated.
 */
function setTag(tag: 'meta' | 'link', key: 'name' | 'property' | 'rel', keyValue: string, value: string | null): void {
  let el = document.head.querySelector<HTMLElement>(`${tag}[${key}="${keyValue}"]`);
  if (value === null) {
    el?.remove();
    return;
  }
  if (!el) {
    el = document.createElement(tag);
    el.setAttribute(key, keyValue);
    document.head.appendChild(el);
  }
  el.setAttribute('data-page-meta', '');
  el.setAttribute(tag === 'link' ? 'href' : 'content', value);
}

const label = (list: { value: string; label: string }[], value: string) => list.find((o) => o.value === value)?.label ?? value;

function absolute(path: string): string {
  return `${window.location.origin}${path}`;
}

function person(author: { id: number; name: string }) {
  return { '@type': 'Person', name: author.name, url: absolute(`/teachers/${author.id}`) };
}

function topics(item: { subject: string; grade_level: string }) {
  return { about: label(SUBJECTS, item.subject), educationalLevel: label(GRADE_LEVELS, item.grade_level) };
}

export function courseMeta(course: CourseView): PageMeta {
  const path = `/courses/${course.id}`;
  const description = summarize(course.description) ?? `A free ${label(SUBJECTS, course.subject)} course by ${course.author.name}: ${course.test_count} practice tests and ${course.material_count} study materials.`;
  return {
    path,
    title: course.title,
    description,
    indexable: course.visibility === 'public',
    jsonLd: {
      '@type': 'Course',
      name: course.title,
      description,
      url: absolute(path),
      author: person(course.author),
      provider: { '@type': 'Organization', name: siteStore.config.identity.name, url: window.location.origin },
      isAccessibleForFree: true,
      ...topics(course),
    },
  };
}

export function practiceMeta(test: PracticeTest): PageMeta {
  const path = `/courses/${test.course.id}/tests/${test.id}`;
  const description = summarize(test.description) ?? `Practise ${test.question_count} questions with answers and explanations, from ${test.course.title}.`;
  return {
    path,
    title: `${test.title} (practice)`,
    description,
    indexable: test.visibility === 'public',
    type: 'article',
    jsonLd: {
      '@type': 'Quiz',
      name: test.title,
      description,
      url: absolute(path),
      author: person(test.author),
      isAccessibleForFree: true,
      isPartOf: { '@type': 'Course', name: test.course.title, url: absolute(`/courses/${test.course.id}`) },
      ...topics(test),
    },
  };
}

export function testMeta(test: TestView): PageMeta {
  const path = `/tests/${test.id}`;
  const description = summarize(test.description) ?? `A ${test.question_count}-question ${label(SUBJECTS, test.subject)} test by ${test.author.name}.`;
  return {
    path,
    title: test.title,
    description,
    indexable: test.visibility === 'public',
    type: 'article',
    jsonLd: {
      '@type': 'Quiz',
      name: test.title,
      description,
      url: absolute(path),
      author: person(test.author),
      isAccessibleForFree: true,
      ...topics(test),
    },
  };
}

export function materialMeta(material: MaterialView): PageMeta {
  const path = `/materials/${material.id}`;
  const description = summarize(material.description) ?? `${label(SUBJECTS, material.subject)} study material by ${material.author.name}.`;
  return {
    path,
    title: material.title,
    description,
    indexable: material.visibility === 'public',
    type: 'article',
    jsonLd: {
      '@type': 'LearningResource',
      name: material.title,
      description,
      url: absolute(path),
      author: person(material.author),
      encodingFormat: material.mime_type,
      isAccessibleForFree: true,
      ...topics(material),
    },
  };
}

/** Only a public profile (one carrying `profile`) is described; a name-only connection view stays out. */
export function teacherMeta(teacher: PublicProfile): PageMeta {
  const path = `/teachers/${teacher.id}`;
  const school = teacher.profile?.school;
  const description = summarize(teacher.profile?.bio) ?? `${teacher.name}${school ? ` (${school})` : ''} shares tests, study materials and courses.`;
  return {
    path,
    title: teacher.name,
    description,
    indexable: teacher.profile !== undefined,
    type: 'profile',
    jsonLd: {
      '@type': 'ProfilePage',
      mainEntity: { '@type': 'Person', name: teacher.name, url: absolute(path), ...(school ? { affiliation: { '@type': 'EducationalOrganization', name: school } } : {}) },
    },
  };
}
