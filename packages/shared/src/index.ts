export type Role = 'teacher' | 'student';

export type Visibility = 'private' | 'connections' | 'public';

export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string | null;
}
