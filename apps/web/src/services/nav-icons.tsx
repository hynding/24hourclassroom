import { h, VNode } from '@stencil/core';

/**
 * The side panel's line icons, drawn for this app on a 24-unit grid. They
 * stroke in `currentColor`, so every palette colours them through the
 * link's own `color` token; no literal colour lives here or in CSS.
 * Decorative: every use sits beside (or is labelled by) visible or
 * screen-reader text, so each svg is aria-hidden.
 */
export type NavIcon =
  | 'panel'
  | 'teachers'
  | 'library'
  | 'tests'
  | 'materials'
  | 'connections'
  | 'integrations'
  | 'notifications'
  | 'profile'
  | 'logout'
  | 'login'
  | 'register';

const PATHS: Record<NavIcon, string[]> = {
  // A rectangle with a divided left column: the conventional side-panel glyph.
  panel: ['M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z', 'M9 4v16'],
  teachers: ['M9 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z', 'M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6', 'M16 4.5a3.5 3.5 0 0 1 0 6.5', 'M18 14.5c1.8.8 3 2.6 3 4.5'],
  library: ['M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5c-.8 0-1.5-.7-1.5-1.5z', 'M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z'],
  tests: ['M9 4h6v3H9z', 'M15 5.5h2.5c.8 0 1.5.7 1.5 1.5v12c0 .8-.7 1.5-1.5 1.5h-11C5.7 20.5 5 19.8 5 19V7c0-.8.7-1.5 1.5-1.5H9', 'M8.5 13.5l2.5 2.5 4.5-5'],
  materials: ['M3.5 7c0-.8.7-1.5 1.5-1.5h4.5l2 2.5H19c.8 0 1.5.7 1.5 1.5v8.5c0 .8-.7 1.5-1.5 1.5H5c-.8 0-1.5-.7-1.5-1.5z'],
  connections: ['M10 14a4 4 0 0 0 5.7 0l3-3a4 4 0 0 0-5.7-5.7l-1.2 1.2', 'M14 10a4 4 0 0 0-5.7 0l-3 3a4 4 0 0 0 5.7 5.7l1.2-1.2'],
  integrations: ['M9 3v5', 'M15 3v5', 'M6.5 8h11v3a5.5 5.5 0 0 1-11 0z', 'M12 16.5V21'],
  notifications: ['M6 16V11a6 6 0 0 1 12 0v5l1.5 2h-15z', 'M10 20.5a2 2 0 0 0 4 0'],
  profile: ['M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z', 'M4.5 20.5c0-4 3.4-6.5 7.5-6.5s7.5 2.5 7.5 6.5'],
  logout: ['M10 4H6c-.8 0-1.5.7-1.5 1.5v13c0 .8.7 1.5 1.5 1.5h4', 'M15 8l4 4-4 4', 'M19 12H9'],
  login: ['M14 4h4c.8 0 1.5.7 1.5 1.5v13c0 .8-.7 1.5-1.5 1.5h-4', 'M9 8l4 4-4 4', 'M13 12H3.5'],
  register: ['M9 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z', 'M3 20c0-3.3 2.7-6 6-6 1.2 0 2.3.3 3.2.9', 'M18 13v7', 'M14.5 16.5h7'],
};

export function navIcon(name: NavIcon): VNode {
  return (
    <svg
      class="icon"
      viewBox="0 0 24 24"
      width="20"
      height="20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.75"
      stroke-linecap="round"
      stroke-linejoin="round"
      aria-hidden="true"
      focusable="false"
    >
      {PATHS[name].map((d) => <path d={d}></path>)}
    </svg>
  );
}
