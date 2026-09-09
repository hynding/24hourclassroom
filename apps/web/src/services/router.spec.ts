import { redirectFor, resolveRoute } from './router';

const verified = { id: 1, email_verified_at: '2026-01-01' } as any;
const unverified = { id: 1, email_verified_at: null } as any;

describe('resolveRoute', () => {
  it('maps static paths to their page tags', () => {
    expect(resolveRoute('/login').tag).toBe('page-login');
    expect(resolveRoute('/profile').tag).toBe('page-profile');
    expect(resolveRoute('/teachers').tag).toBe('page-teachers');
    expect(resolveRoute('/nonsense').tag).toBe('page-home');
  });

  it('parses the teacher id out of /teachers/:id', () => {
    expect(resolveRoute('/teachers/42')).toEqual({ tag: 'page-teacher-profile', teacherId: 42 });
  });

  it('leaves teacherId undefined for a non-numeric segment', () => {
    expect(resolveRoute('/teachers/abc')).toEqual({ tag: 'page-teacher-profile', teacherId: undefined });
  });
});

describe('redirectFor', () => {
  it('bounces signed-in users off guest-only pages', () => {
    expect(redirectFor('/login', verified)).toBe('/');
  });

  it('sends signed-out users away from auth-only pages', () => {
    expect(redirectFor('/profile', null)).toBe('/login');
  });

  it('steers unverified users to the verification notice', () => {
    expect(redirectFor('/', unverified)).toBe('/verify-email');
  });

  it('lets unverified users browse the public directory', () => {
    expect(redirectFor('/teachers', unverified)).toBeNull();
    expect(redirectFor('/teachers/42', unverified)).toBeNull();
  });

  it('lets signed-out visitors browse the public directory', () => {
    expect(redirectFor('/teachers', null)).toBeNull();
    expect(redirectFor('/teachers/42', null)).toBeNull();
  });

  it('does not redirect a verified user browsing normally', () => {
    expect(redirectFor('/', verified)).toBeNull();
    expect(redirectFor('/profile', verified)).toBeNull();
  });
});
