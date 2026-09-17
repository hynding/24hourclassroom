import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/tests' }];

type AdminTest = {
    id: number;
    title: string;
    subject: string;
    grade_level: string;
    author: { id: number; name: string };
    question_count: number;
    published_at: string | null;
};

type Paginated<T> = { data: T[]; current_page: number; last_page: number; prev_page_url: string | null; next_page_url: string | null };

export default function AdminTests({ tests, filters }: { tests: Paginated<AdminTest>; filters: { q: string | null } }) {
    const [search, setSearch] = useState(filters.q ?? '');

    const submitSearch: FormEventHandler = (e) => {
        e.preventDefault();
        router.get('/admin/tests', { q: search || undefined }, { preserveState: true, replace: true });
    };

    const unpublish = (test: AdminTest) => {
        if (confirm(`Unpublish "${test.title}"? The author will be notified.`)) {
            router.post(`/admin/tests/${test.id}/unpublish`, {}, { preserveScroll: true });
        }
    };

    const remove = (test: AdminTest) => {
        if (confirm(`Delete "${test.title}" and every attempt on it? This cannot be undone.`)) {
            router.delete(`/admin/tests/${test.id}`, { preserveScroll: true });
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: tests" />
            <div className="space-y-6 px-4 py-6">
                <HeadingSmall title="Public tests" description="Unpublish or delete tests that do not meet the guidelines." />
                <form onSubmit={submitSearch} className="flex items-end gap-2">
                    <div className="grid gap-2">
                        <Label htmlFor="q">Search</Label>
                        <Input id="q" className="w-64" value={search} onChange={(e) => setSearch(e.target.value)} placeholder="Title" />
                    </div>
                    <Button type="submit">Search</Button>
                </form>
                <div className="overflow-x-auto">
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Title</th>
                                <th className="py-2 pr-4">Author</th>
                                <th className="py-2 pr-4">Subject</th>
                                <th className="py-2 pr-4">Grade</th>
                                <th className="py-2 pr-4">Questions</th>
                                <th className="py-2 pr-4">Published</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {tests.data.map((test) => (
                                <tr key={test.id} className="border-b">
                                    <td className="py-2 pr-4">{test.title}</td>
                                    <td className="py-2 pr-4">{test.author.name}</td>
                                    <td className="py-2 pr-4">{test.subject}</td>
                                    <td className="py-2 pr-4">{test.grade_level}</td>
                                    <td className="py-2 pr-4">{test.question_count}</td>
                                    <td className="py-2 pr-4">{test.published_at ? new Date(test.published_at).toLocaleDateString() : ''}</td>
                                    <td className="flex gap-2 py-2">
                                        <Button variant="outline" size="sm" onClick={() => unpublish(test)}>
                                            Unpublish
                                        </Button>
                                        <Button variant="destructive" size="sm" onClick={() => remove(test)}>
                                            Delete
                                        </Button>
                                    </td>
                                </tr>
                            ))}
                            {tests.data.length === 0 && (
                                <tr>
                                    <td className="py-4" colSpan={7}>
                                        No public tests match.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
                <div className="flex gap-2">
                    <Button variant="outline" disabled={!tests.prev_page_url} onClick={() => tests.prev_page_url && router.get(tests.prev_page_url)}>
                        Previous
                    </Button>
                    <span className="self-center text-sm">
                        Page {tests.current_page} of {tests.last_page}
                    </span>
                    <Button variant="outline" disabled={!tests.next_page_url} onClick={() => tests.next_page_url && router.get(tests.next_page_url)}>
                        Next
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
