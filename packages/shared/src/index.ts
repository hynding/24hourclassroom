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

/**
 * The per-file upload cap, in bytes. A LITERAL, not `10 * 1024 * 1024`:
 * TaxonomyMirrorTest reads it with a digit-capturing regex, the same way it
 * reads enum `value:` entries, and asserts it equals
 * `config('materials.max_file_kb') * 1024` on the PHP side. 10 MB.
 */
export const MAX_MATERIAL_BYTES = 10485760;

/** A material as it appears in any list (own, shared-with-me, library). */
export interface MaterialSummary {
  id: number;
  title: string;
  subject: Subject;
  grade_level: GradeLevel;
  visibility: Visibility;
  published_at: string | null;
  /** The client filename, basenamed and truncated to 255 by the server. */
  original_name: string;
  /** Server-detected, never the client's claim. */
  mime_type: string;
  size_bytes: number;
  author: TestAuthor;
}

export interface Material extends MaterialSummary {
  description: string | null;
  created_at: string;
  updated_at: string;
}

/**
 * The shape of EVERY single-material response: show, create, update, publish
 * and unpublish all return this, so a spread-merge after an action can never
 * drop `download_url`. That URL is a 15-minute signed link.
 */
export interface MaterialView extends Material {
  is_author: boolean;
  shared_with_me: boolean;
  download_url: string;
}

/** An item of GET /api/materials/shared: a summary plus when it was shared. */
export interface SharedMaterial extends MaterialSummary {
  /** Null when the share-time alias is absent from the row. */
  shared_at: string | null;
}

/** A row of GET /api/materials/{id}/shares. `id` is the SHARE id, not the user's. */
export interface MaterialShare {
  id: number;
  user: TestAuthor & { role: Role };
  created_at: string;
}

/** Per-id outcome of POST /api/materials/{id}/shares. Never says why. */
export interface ShareResult {
  id: number;
  status: 'shared' | 'not_found';
}

/** Multipart create. `title` absent => the server uses the filename stem. */
export interface MaterialUpload {
  file: File;
  title?: string;
  description?: string | null;
  subject: Subject;
  grade_level: GradeLevel;
}

/** Metadata-only update. The file itself is never replaceable. */
export interface MaterialUpdate {
  title: string;
  description?: string | null;
  subject: Subject;
  grade_level: GradeLevel;
}

/**
 * Mirrors App\Enums\GenerationStatus. The last four are terminal: the SPA
 * stops polling on them, and nothing ever leaves a terminal state.
 * `awaiting_tool` means a draft has been accepted and committed but its tool
 * result has not been sent back to Anthropic yet, so it is still live.
 */
export type GenerationStatus =
  | 'queued'
  | 'running'
  | 'awaiting_tool'
  | 'done'
  | 'failed'
  | 'cancelled'
  | 'budget_reached';

export const GENERATION_STATUSES: TaxonomyOption<GenerationStatus>[] = [
  { value: 'queued', label: 'Queued' },
  { value: 'running', label: 'Running' },
  { value: 'awaiting_tool', label: 'Saving draft' },
  { value: 'done', label: 'Done' },
  { value: 'failed', label: 'Failed' },
  { value: 'cancelled', label: 'Cancelled' },
  { value: 'budget_reached', label: 'Budget reached' },
];

/**
 * The generation limits, mirrored from config/generation.php. LITERALS, not
 * expressions and with no type annotation, for the same reason
 * MAX_MATERIAL_BYTES is one: TaxonomyMirrorTest reads each with a
 * digit-capturing regex (`export const X = (\d+);`) and asserts it equals
 * `config('generation.*')`. A `: number` or a `2 * 100` here silently ends
 * the mirror -- and the SPA's form bounds and the server's validation rules
 * would then be free to drift apart.
 */
export const GENERATION_BUDGET_CENTS = 200;
export const GENERATION_MAX_MATERIALS = 5;
export const GENERATION_MIN_QUESTIONS = 5;
export const GENERATION_MAX_QUESTIONS = 30;

/**
 * How often page-generation polls. SPA-only -- progress is poll-driven
 * because the shared host has no queue worker, and the server has no opinion
 * about the interval, so this one has no PHP counterpart and is not mirrored.
 * On a 429 the page doubles it (10, 20, 30 s clamped) and resets on success.
 */
export const GENERATION_POLL_MS = 5000;

/** A personal access token for the MCP server. The hash is never returned. */
export interface McpToken {
  id: number;
  name: string;
  /** Null until the teacher's Claude client has actually connected. */
  last_used_at: string | null;
  created_at: string;
}

/**
 * The only payload that ever carries the plaintext token, returned once by
 * POST /api/integrations/mcp-tokens. It is not stored anywhere on the client.
 */
export interface McpTokenCreated {
  id: number;
  name: string;
  token: string;
}

/** The stored key is never returned -- only whether it exists, and its last four. */
export interface AnthropicIntegration {
  configured: boolean;
  hint: string | null;
  verified_at: string | null;
}

export interface Integrations {
  mcp_tokens: McpToken[];
  anthropic: AnthropicIntegration;
}

/**
 * One generation run. `agent_note` is the agent's latest message (earlier
 * ones are not kept), `error` is set on every failed and budget-reached row
 * and on a system-initiated cancel, and `list_cost_cents` is informational --
 * Anthropic's list price for the session, never compared with the budget.
 */
export interface Generation {
  id: number;
  title: string;
  subject: Subject;
  grade_level: GradeLevel;
  instructions: string | null;
  question_count: number;
  material_ids: number[];
  status: GenerationStatus;
  agent_note: string | null;
  error: string | null;
  list_cost_cents: number | null;
  test_id: number | null;
  started_at: string | null;
  finished_at: string | null;
  created_at: string;
}

/** POST /api/generations. Materials must be the teacher's OWN (see the spec's decision 5). */
export interface GenerationInput {
  title: string;
  subject: Subject;
  grade_level: GradeLevel;
  instructions?: string | null;
  question_count: number;
  material_ids: number[];
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
    material_id?: number;
    material_title?: string;
  };
}
