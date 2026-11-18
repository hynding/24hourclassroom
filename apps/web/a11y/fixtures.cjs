// API responses for a11y/audit.cjs: just enough of each payload for the page to render fully.

const author = { id: 1, name: 'Ms K' };
const student = { id: 9, name: 'Ada', email: 'ada@example.com', email_verified_at: '2026-01-01', role: 'student' };
const day = (o) => { const d = new Date(); d.setDate(d.getDate() + o); return d.toISOString().slice(0, 10) + 'T00:00:00.000000Z'; };
const test = {
  id: 9, title: 'AP Biology · Week 01 · Quiz · Water', description: 'Five questions on water.', subject: 'science', grade_level: '9-12', visibility: 'public',
  published_at: '2026-09-01', comments_enabled: true, copied_from_id: null, question_count: 3, author, created_at: '', updated_at: '',
  questions: [
    { id: 10, position: 0, type: 'multiple_choice', prompt: 'Which organelle makes ATP?', stimulus: null, options: ['Nucleus', 'Mitochondria', 'Ribosome', 'Golgi'], points: 2, partial_credit: false, auto_grade: true, answer: 1, explanation: 'Makes ATP.', option_explanations: ['Holds DNA.', 'Right.', 'Makes protein.', 'Packages.'] },
    { id: 11, position: 1, type: 'true_false', prompt: 'Cells divide.', stimulus: null, options: null, points: 1, partial_credit: false, auto_grade: true, answer: true, explanation: null },
    { id: 12, position: 2, type: 'short_answer', prompt: 'Why is water polar?', stimulus: null, options: null, points: 3, partial_credit: false, auto_grade: true, answer: 'Electronegativity.', explanation: null },
  ],
};
const material = { id: 1, title: 'AP Biology · Week 01 · Study Guide', subject: 'science', grade_level: '9-12', visibility: 'public', published_at: '2026-09-01', original_name: 'guide.md', mime_type: 'text/plain', size_bytes: 900, author };
const items = [
  { id: 5, position: 0, section: 'Unit 1 · Chemistry of Life', kind: 'material', material },
  { id: 6, position: 1, section: 'Unit 1 · Chemistry of Life', kind: 'test', test: { id: 9, title: test.title, visibility: 'public', question_count: 3 } },
  { id: 7, position: 2, section: 'Unit 2 · Cells', kind: 'test', test: { id: 8, title: 'AP Biology · Week 02 · Quiz · Cells', visibility: 'public', question_count: 12 } },
];
const course = (who) => ({
  id: 3, title: 'AP Biology', subject: 'science', grade_level: '9-12', visibility: 'public', published_at: '2026-09-01', test_count: 2, material_count: 1, author,
  description: 'A full year of AP Biology.', created_at: '', updated_at: '', is_author: false, branched_from: null, can_branch: false, my_branch_id: null,
  comment_reactions: false, path: '/courses/3', items,
  progress: who === 'student' ? { items: { 5: { done_at: day(-1), best_score: null, best_max: null }, 6: { done_at: day(-1), best_score: 2, best_max: 3 } } } : null,
});
const paged = (data) => ({ data, meta: { current_page: 1, last_page: 1, per_page: 20, total: data.length } });
const summary = (submitted_at) => ({ id: 70, test_id: 9, assignment_id: 1, started_at: day(-2), submitted_at, score: submitted_at ? '8.00' : null, max_score: '10.00', graded_at: null, ungraded_count: 0 });
const assignment = (id, due, latest) => ({ id, due_at: due, latest, best: latest, test: { id, title: `Quiz ${id}`, subject: 'science', grade_level: '9-12', question_count: 10, author } });

exports.respond = (route, who, theme) => {
  const u = new URL(route.request().url());
  const p = u.pathname;
  const json = (body, status = 200) => route.fulfill({ status, contentType: 'application/json', body: JSON.stringify(body) });
  if (p === '/sanctum/csrf-cookie') return route.fulfill({ status: 204 });
  if (p === '/api/site') return json({ theme: { layout: theme.layout, palette: theme.palette, typeset: 'editorial' }, identity: { name: '24 Hour Classroom', tagline: 'Free courses and practice tests.' }, registration: { open: true, message: null }, banner: { enabled: false, text: null } });
  if (p === '/api/user') return who === 'guest' ? json({ message: 'Unauthenticated.' }, 401) : json(who === 'teacher' ? { ...student, id: 1, name: 'Ms K', role: 'teacher' } : student);
  if (p === '/api/tests/9') return json({ ...test, is_author: who === 'teacher', assignment: null, open_attempt_id: null, questions: test.questions.map(({ answer, explanation, option_explanations, ...q }) => who === 'teacher' ? { ...q, answer, explanation, option_explanations } : q) });
  if (p === '/api/tests' && who === 'teacher') return json(paged([{ ...test, questions: undefined, assignment_count: 2 }]));
  if (p === '/api/generations') return json({ data: [] });
  if (p === '/api/grading') return json({ data: [{ ...summary(day(-1)), ungraded_count: 1, student: { id: 9, name: 'Ada' }, test: { id: 9, title: test.title }, teacher: author }] });
  if (p === '/api/materials' && who === 'teacher') return json(paged([material]));
  if (p === '/api/courses' && who === 'teacher') return json(paged([course('teacher')]));
  if (p === '/api/courses/candidates') return json({ tests: [{ id: 9, title: test.title, visibility: 'public', question_count: 3 }], materials: [{ id: 1, title: material.title, visibility: 'public', original_name: 'guide.md' }] });
  if (p === '/api/users/1') return json({ id: 1, name: 'Ms K', role: 'teacher', avatar_url: null, path: '/teachers/1', profile: { bio: 'Biology teacher.', school: 'Lincoln High', specialties: null, subjects: ['science'], grade_levels: ['9-12'] }, follower_count: 3, following_count: 1, is_following: false, connection: null, tests: [], materials: [], courses: [] });
  if (p === '/api/notifications/unread-count' || p.startsWith('/api/notifications')) return json({ count: 0, data: [], meta: { current_page: 1, last_page: 1, per_page: 20, total: 0 } });
  if (p === '/api/courses/3') return json(course(who));
  if (p === '/api/courses/3/tests/9') return json({ ...test, course: { id: 3, title: 'AP Biology', path: '/courses/3', author }, progress: who === 'student' ? { best_score: 2, best_max: 3, runs: 1, done_at: day(-1) } : null });
  if (p === '/api/materials/1') return json({ ...material, description: 'Week 1 reading.', created_at: '', updated_at: '', is_author: false, shared_with_me: false, download_url: 'http://localhost:8000/api/materials/1/file', progress: who === 'student' ? { done_at: null, known_cards: [] } : null });
  if (p === '/api/materials/2') return json({ ...material, id: 2, title: 'AP Biology · Week 01 · Flashcards', original_name: 'week-01.flashcards.md', mime_type: 'text/markdown', description: null, created_at: '', updated_at: '', is_author: false, shared_with_me: false, download_url: 'http://localhost:8000/api/materials/2/file', progress: who === 'student' ? { done_at: null, known_cards: [] } : null });
  if (p === '/api/materials/2/file') return route.fulfill({ status: 200, contentType: 'text/markdown', body: '# Week 1\n\n## What makes water polar?\nOxygen pulls shared electrons harder than hydrogen.\nHint: electronegativity\nTopic: 1.1\n\n## What is cohesion?\nWater molecules sticking to each other.\n' });
  if (p === '/api/materials/2/cards') return json({ done_at: null, known_cards: JSON.parse(route.request().postData()).known });
  if (p === '/api/materials/1/file') return route.fulfill({ status: 200, contentType: 'text/plain', body: '# Water\n\nWater is **polar**.\n\n- Hydrogen bonds\n- Cohesion' });
  if (p === '/api/comments') return json({ data: [], can_comment: who !== 'guest', can_moderate: false, can_approve: false, moderated: false, reactions_enabled: false, closed: false });
  if (p === '/api/connections') return json({ data: [{ id: 4, user: { id: 1, name: 'Ms K', role: 'teacher', avatar_url: null } }] });
  if (p === '/api/connections/pending') return json({ incoming: [{ id: 5, user: { id: 7, name: 'Mr T', role: 'teacher', avatar_url: null } }], outgoing: [] });
  if (p === '/api/connections/code') return json({ code: 'ABCD-1234' });
  if (p === '/api/integrations') return json({ mcp_tokens: [{ id: 1, name: 'Claude Code', last_used_at: null, created_at: day(-3) }], anthropic: { configured: false, hint: null, verified_at: null } });
  if (p.startsWith('/api/library/materials') || p === '/api/materials/shared') return json(paged([material]));
  if (p === '/api/profile') return json({ id: 9, name: 'Ada', email: 'ada@example.com', role: who === 'teacher' ? 'teacher' : 'student', avatar_url: null, profile: { bio: null, school: null, specialties: null, subjects: [], grade_levels: [] } });
  if (p.startsWith('/api/library/courses')) return json(paged([{ id: 3, title: 'AP Biology', subject: 'science', grade_level: '9-12', visibility: 'public', published_at: '2026-09-01', test_count: 38, material_count: 35, author }]));
  if (p.startsWith('/api/library')) return json(paged([{ ...test, questions: undefined }]));
  if (p.startsWith('/api/teachers')) return json(paged([{ id: 1, name: 'Ms K', role: 'teacher', avatar_url: null, profile: { bio: 'Biology teacher.', school: 'Lincoln High', specialties: null, subjects: ['science'], grade_levels: ['9-12'] }, follower_count: 3 }]));
  if (p === '/api/assignments') return json({ data: [assignment(1, day(-2), summary(null)), assignment(2, day(3), null), assignment(3, day(20), null), assignment(4, day(-6), summary(day(-1)))] });
  if (p === '/api/attempts') return json({ data: [] });
  console.log(`a11y fixtures: no mock for ${p}`);
  return json({ data: [] });
};
