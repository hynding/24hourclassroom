export type Role = 'teacher' | 'student' | 'admin';

/** Roles a user may choose for themselves. Admin is assigned, never requested. */
export type RegistrationRole = Exclude<Role, 'admin'>;

export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string | null;
  role: Role;
}

export type Subject =
  | 'math'
  | 'science'
  | 'english-language-arts'
  | 'social-studies'
  | 'art'
  | 'music'
  | 'pe'
  | 'world-languages'
  | 'computer-science'
  | 'special-education'
  | 'other';

export type GradeLevel = 'k-2' | '3-5' | '6-8' | '9-12' | 'higher-ed';

export interface TaxonomyOption<T> {
  value: T;
  label: string;
}

export const SUBJECTS: TaxonomyOption<Subject>[] = [
  { value: 'math', label: 'Math' },
  { value: 'science', label: 'Science' },
  { value: 'english-language-arts', label: 'English/Language Arts' },
  { value: 'social-studies', label: 'Social Studies' },
  { value: 'art', label: 'Art' },
  { value: 'music', label: 'Music' },
  { value: 'pe', label: 'PE' },
  { value: 'world-languages', label: 'World Languages' },
  { value: 'computer-science', label: 'Computer Science' },
  { value: 'special-education', label: 'Special Education' },
  { value: 'other', label: 'Other' },
];

export const GRADE_LEVELS: TaxonomyOption<GradeLevel>[] = [
  { value: 'k-2', label: 'K-2' },
  { value: '3-5', label: '3-5' },
  { value: '6-8', label: '6-8' },
  { value: '9-12', label: '9-12' },
  { value: 'higher-ed', label: 'Higher Ed' },
];

/** Shared by tests (C1) and materials (C2). Mirrors App\Enums\Visibility. */
export type Visibility = 'private' | 'public';

export const VISIBILITIES: TaxonomyOption<Visibility>[] = [
  { value: 'private', label: 'Private' },
  { value: 'public', label: 'Public' },
];

export type QuestionType = 'multiple_choice' | 'multi_select' | 'true_false' | 'short_answer' | 'numeric';

export const QUESTION_TYPES: TaxonomyOption<QuestionType>[] = [
  { value: 'multiple_choice', label: 'Multiple choice' },
  { value: 'multi_select', label: 'Select all that apply' },
  { value: 'true_false', label: 'True / false' },
  { value: 'short_answer', label: 'Short answer' },
  { value: 'numeric', label: 'Numeric' },
];

export interface TestAuthor {
  id: number;
  name: string;
}

export interface NumericAnswer {
  value: number;
  tolerance?: number;
}

/** `answer` and `explanation` are ABSENT (not null) unless the viewer is the author. */
export interface Question {
  id: number;
  position: number;
  type: QuestionType;
  prompt: string;
  options: string[] | null;
  points: number;
  partial_credit: boolean;
  answer?: unknown;
  explanation?: string | null;
}

export interface QuestionInput {
  id?: number;
  type: QuestionType;
  prompt: string;
  options?: string[];
  answer: unknown;
  points?: number;
  partial_credit?: boolean;
  explanation?: string | null;
}

export interface TestSummary {
  id: number;
  title: string;
  subject: Subject;
  grade_level: GradeLevel;
  visibility: Visibility;
  published_at: string | null;
  question_count: number;
  author: TestAuthor;
  /** Only on GET /api/tests (the author's own list). */
  assignment_count?: number;
}

export interface Test extends TestSummary {
  description: string | null;
  copied_from_id: number | null;
  questions: Question[];
  created_at: string;
  updated_at: string;
}

/** GET /api/tests/{id}: the test plus the viewer's relationship to it. */
export interface TestView extends Test {
  is_author: boolean;
  assignment: { id: number; due_at: string | null } | null;
  open_attempt_id: number | null;
  can_copy: boolean;
}

export interface TestInput {
  title: string;
  description?: string | null;
  subject: Subject;
  grade_level: GradeLevel;
  questions: QuestionInput[];
}

/** Decimals arrive as strings ("2.00") from Laravel's decimal cast. */
export interface AttemptSummary {
  id: number;
  test_id: number;
  assignment_id: number | null;
  started_at: string;
  submitted_at: string | null;
  score: string | null;
  max_score: string | null;
  graded_at: string | null;
  ungraded_count: number;
}

export interface AttemptQuestion extends Question {
  response: unknown;
  /** Present after submit. */
  answer_id?: number;
  awarded?: string | null;
  graded_answer?: { answer: unknown; points: number } | null;
}

export interface AttemptTestRef {
  id: number;
  title: string;
  subject: Subject;
  grade_level: GradeLevel;
}

export interface Attempt extends AttemptSummary {
  student: TestAuthor;
  test: AttemptTestRef;
  questions: AttemptQuestion[];
}

export interface MyAttempt extends AttemptSummary {
  test: AttemptTestRef;
}

export interface MyAssignment {
  id: number;
  due_at: string | null;
  test: AttemptTestRef & { question_count: number; author: TestAuthor };
  latest: AttemptSummary | null;
  best: AttemptSummary | null;
}

export interface AssignmentRow {
  id: number;
  student: TestAuthor;
  due_at: string | null;
  latest: AttemptSummary | null;
  best: AttemptSummary | null;
}

export interface AssignmentResult {
  assignment_id: number;
  student: TestAuthor;
  due_at: string | null;
  attempts: AttemptSummary[];
  latest: AttemptSummary | null;
  best: AttemptSummary | null;
}

export interface AssignResult {
  id: number;
  status: 'assigned' | 'not_found';
}

export interface LibraryFilters {
  subject?: Subject;
  grade?: GradeLevel;
  q?: string;
  page?: number;
}

export type Layout = 'stacked' | 'rail';
export type Palette = 'noon' | 'evening' | 'slate' | 'afternoon';
export type Typeset = 'editorial' | 'modern';

/**
 * `scheme` and `surface` are NOT tokens. They exist so the SPA's inline boot
 * script can paint the canvas from the cache before any CSS has arrived. A
 * spec asserts each entry matches its palette file, so they cannot drift.
 */
export interface PaletteOption extends TaxonomyOption<Palette> {
  scheme: 'light' | 'dark';
  surface: string;
}

export const LAYOUTS: TaxonomyOption<Layout>[] = [
  { value: 'stacked', label: 'Stacked' },
  { value: 'rail', label: 'Rail' },
];

export const PALETTES: PaletteOption[] = [
  { value: 'noon', label: 'Noon', scheme: 'light', surface: '#fdfcf8' },
  { value: 'evening', label: 'Evening', scheme: 'dark', surface: '#15191e' },
  { value: 'slate', label: 'Slate', scheme: 'light', surface: '#ffffff' },
  { value: 'afternoon', label: 'Afternoon', scheme: 'light', surface: '#f6f9f4' },
];

export const TYPESETS: TaxonomyOption<Typeset>[] = [
  { value: 'editorial', label: 'Editorial' },
  { value: 'modern', label: 'Modern' },
];

export interface SiteTheme {
  layout: Layout;
  palette: Palette;
  typeset: Typeset;
}

export const DEFAULT_THEME: SiteTheme = { layout: 'stacked', palette: 'noon', typeset: 'editorial' };

export interface SiteConfig {
  theme: SiteTheme;
}

export interface Profile {
  bio: string | null;
  school: string | null;
  specialties: string | null;
  subjects: Subject[];
  grade_levels: GradeLevel[];
  avatar_url: string | null;
}

export interface TeacherSummary {
  id: number;
  name: string;
  school: string | null;
  subjects: Subject[];
  grade_levels: GradeLevel[];
  avatar_url: string | null;
}

export interface PublicProfile {
  id: number;
  name: string;
  role: Role;
  /** Absent entirely for a student seen by an accepted connection. */
  profile?: Profile;
  /** Absent (not null) on the same name-only student payload as `profile`. */
  is_following?: boolean | null;
  /** Absent (not null) on the same name-only student payload as `profile`. */
  connection?: ViewerConnectionState | null;
}

export interface Paginated<T> {
  data: T[];
  meta: {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
  };
}

/**
 * The counterpart in a connection or notification.
 *
 * Everything but `id` is OPTIONAL because the server genuinely omits it:
 * `GET /api/connections/pending` reduces an OUTGOING request addressed to a
 * student to `{ id }` alone, so a teacher cannot harvest student identities
 * by walking the id space with connection requests (decision 5 -- student
 * identity is revealed to an ACCEPTED connection, and a pending request is
 * not one).
 *
 * Declaring them required would be the type lying about the payload, which
 * is how the `profile` and `is_following` bugs got onto this branch.
 * apps/web sets no `"strict"`, so the compiler will NOT flag an unguarded
 * dereference of these -- guard them by hand.
 */
export interface UserSummary {
  id: number;
  name?: string;
  role?: Role;
  avatar_url?: string | null;
}

export type ConnectionStatus = 'pending' | 'accepted';

/** From the viewer's point of view: did they ask, or were they asked? */
export type ConnectionDirection = 'incoming' | 'outgoing';

export interface Connection {
  id: number;
  user: UserSummary;
}

export interface PendingConnections {
  incoming: Connection[];
  outgoing: Connection[];
}

export interface ViewerConnectionState {
  id: number;
  status: ConnectionStatus;
  direction: ConnectionDirection;
}

export interface AppNotification {
  id: string;
  type: string;
  read_at: string | null;
  created_at: string;
  data: {
    user?: UserSummary;
    message?: string;
    test_id?: number;
    test_title?: string;
    assignment_id?: number;
    attempt_id?: number;
    due_at?: string | null;
    score?: string | null;
    max_score?: string | null;
    ungraded_count?: number;
  };
}
