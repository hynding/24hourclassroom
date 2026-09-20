import { type NavItem } from '@/types';
import { FileText, FolderOpen, LayoutGrid, Palette, Users } from 'lucide-react';

/**
 * The admin-only links are role-gated, not just visually hidden: an
 * unauthenticated/non-admin caller never gets them back. Shared between the
 * sidebar and header shells so a future switch to the header layout cannot
 * silently drop the Users / Site theme links the way a second, divergent
 * hard-coded list once did.
 */
export function mainNavItems(role: string | undefined): NavItem[] {
    return [
        { title: 'Dashboard', href: '/dashboard', icon: LayoutGrid },
        ...(role === 'admin'
            ? [
                  { title: 'Users', href: '/admin/users', icon: Users },
                  { title: 'Site theme', href: '/admin/site-theme', icon: Palette },
                  { title: 'Tests', href: '/admin/tests', icon: FileText },
                  { title: 'Materials', href: '/admin/materials', icon: FolderOpen },
              ]
            : []),
    ];
}
