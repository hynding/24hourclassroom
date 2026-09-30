import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '/admin/users',
    },
];

type AdminUser = {
    id: number;
    name: string;
    email: string;
    role: string;
    verified: boolean;
    active: boolean;
};

type Paginated<T> = {
    data: T[];
    current_page: number;
    last_page: number;
    prev_page_url: string | null;
    next_page_url: string | null;
};

export default function AdminUsers({
    users,
    filters,
    notice,
}: {
    users: Paginated<AdminUser>;
    filters: { q: string | null };
    notice: string | null;
}) {
    const [search, setSearch] = useState(filters.q ?? '');

    const submitSearch: FormEventHandler = (e) => {
        e.preventDefault();

        router.get('/admin/users', { q: search || undefined }, { preserveState: true, replace: true });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: users" />

            <div className="space-y-6 px-4 py-6">
                <HeadingSmall title="Users" description="Open a user to see their account and act on it." />

                {notice && <p className="text-muted-foreground text-sm">{notice}</p>}

                <form onSubmit={submitSearch} className="flex items-end gap-2">
                    <div className="grid gap-2">
                        <Label htmlFor="q">Search</Label>
                        <Input id="q" className="w-64" value={search} onChange={(e) => setSearch(e.target.value)} placeholder="Name or email" />
                    </div>
                    <Button type="submit">Search</Button>
                </form>

                <div className="overflow-x-auto">
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Name</th>
                                <th className="py-2 pr-4">Email</th>
                                <th className="py-2 pr-4">Role</th>
                                <th className="py-2 pr-4">Verified</th>
                                <th className="py-2 pr-4">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            {users.data.map((user) => (
                                <tr key={user.id} className="border-b">
                                    <td className="py-2 pr-4">
                                        <Link href={`/admin/users/${user.id}`} className="underline">
                                            {user.name}
                                        </Link>
                                    </td>
                                    <td className="py-2 pr-4">{user.email}</td>
                                    <td className="py-2 pr-4">{user.role}</td>
                                    <td className="py-2 pr-4">{user.verified ? 'Yes' : 'No'}</td>
                                    <td className="py-2 pr-4">{user.active ? 'Yes' : 'No'}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                <div className="flex items-center gap-2">
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        disabled={!users.prev_page_url}
                        onClick={() => users.prev_page_url && router.get(users.prev_page_url, {}, { preserveState: true })}
                    >
                        Previous
                    </Button>
                    <span className="text-muted-foreground text-sm">
                        Page {users.current_page} of {users.last_page}
                    </span>
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        disabled={!users.next_page_url}
                        onClick={() => users.next_page_url && router.get(users.next_page_url, {}, { preserveState: true })}
                    >
                        Next
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
