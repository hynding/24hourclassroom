export type Role = 'teacher' | 'student';

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
  profile: Profile;
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
