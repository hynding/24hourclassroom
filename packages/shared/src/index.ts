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
  data: { user?: UserSummary; message?: string };
}
