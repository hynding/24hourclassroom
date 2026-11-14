import { h, VNode } from '@stencil/core';

/**
 * The comment-thread's state and thumb icons, on the same 24-unit grid and
 * in `currentColor` as nav-icons. Decorative: each use carries its own text
 * (a tooltip plus screen-reader text, or a labelled button).
 */
export type CommentIcon = 'pending' | 'denied' | 'deleted' | 'up' | 'down';

const PATHS: Record<CommentIcon, string[]> = {
  // A pause sign in a ring: on hold until someone approves it.
  pending: ['M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18z', 'M10 9v6', 'M14 9v6'],
  // A ring with a bar through it: turned away.
  denied: ['M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18z', 'M5.6 5.6l12.8 12.8'],
  deleted: ['M4 7h16', 'M9.5 7V4.5h5V7', 'M6 7l1 13h10l1-13', 'M10 11v5', 'M14 11v5'],
  up: ['M7 11v9H4.5c-.8 0-1.5-.7-1.5-1.5v-6c0-.8.7-1.5 1.5-1.5z', 'M7 11l4-7.5c1.4 0 2.5 1.1 2.5 2.5v3.5h5c1 0 1.7.9 1.5 1.8l-1.5 7.5c-.2.7-.8 1.2-1.5 1.2H7'],
  down: ['M7 13V4H4.5C3.7 4 3 4.7 3 5.5v6c0 .8.7 1.5 1.5 1.5z', 'M7 13l4 7.5c1.4 0 2.5-1.1 2.5-2.5v-3.5h5c1 0 1.7-.9 1.5-1.8L18.5 5.2c-.2-.7-.8-1.2-1.5-1.2H7'],
};

export function commentIcon(name: CommentIcon): VNode {
  return (
    <svg
      class="icon"
      viewBox="0 0 24 24"
      width="18"
      height="18"
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
