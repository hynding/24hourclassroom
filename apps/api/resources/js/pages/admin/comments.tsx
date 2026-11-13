import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/comments' }];

type Status = 'pending' | 'approved' | 'denied';
type Target = 'test' | 'question' | 'material' | 'course';

type AdminComment = {
    id: number;
    body: string;
    status: Status;
    created_at: string;
    edited_at: string | null;
    deleted_at: string | null;
    is_reply: boolean;
    parent_deleted: boolean;
    author: { id: number; name: string; role: string } | null;
    target: { type: Target; title: string; url: string | null };
    moderated: boolean;
};

type Paginated<T> = { data: T[]; current_page: number; last_page: number; total: number; prev_page_url: string | null; next_page_url: string | null };

type Filters = { q: string | null; status: Status | 'deleted' | null; target: Target | null };

const TARGET_LABELS: Record<Target, string> = { test: 'Test', question: 'Question', material: 'Material', course: 'Course' };
const STATUS_OPTIONS: { value: Filters['status']; label: string }[] = [
    { value: null, label: 'All' },
    { value: 'pending', label: 'Pending' },
    { value: 'approved', label: 'Approved' },
    { value: 'denied', label: 'Denied' },
    { value: 'deleted', label: 'Deleted' },
];

const selectClass = 'border-input bg-background h-9 rounded-md border px-3 text-sm';

export default function AdminComments({ comments, filters, pendingCount }: { comments: Paginated<AdminComment>; filters: Filters; pendingCount: number }) {
    const [search, setSearch] = useState(filters.q ?? '');

    const go = (next: Partial<Filters>) => {
        const merged = { ...filters, q: search || null, ...next };
        router.get(
            '/admin/comments',
            { q: merged.q || undefined, status: merged.status || undefined, target: merged.target || undefined },
            { preserveState: true, replace: true },
        );
    };

    const submitSearch: FormEventHandler = (e) => {
        e.preventDefault();
        go({});
    };

    const post = (comment: AdminComment, action: 'approve' | 'deny' | 'restore') =>
        router.post(`/admin/comments/${comment.id}/${action}`, {}, { preserveScroll: true });

    const remove = (comment: AdminComment) => {
        if (confirm('Delete this comment and its replies? Only administrators will still see them, and you can restore them here.')) {
            router.delete(`/admin/comments/${comment.id}`, { preserveScroll: true });
        }
    };

    const state = (c: AdminComment) => (c.deleted_at ? 'Deleted' : c.status.charAt(0).toUpperCase() + c.status.slice(1));

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: comments" />
            <div className="space-y-6 px-4 py-6">
                <HeadingSmall
                    title="Comments"
                    description={`Every comment on the site, newest first. Only a public course's discussion waits for approval${pendingCount ? ` (${pendingCount} pending)` : ''}.`}
                />
                <form onSubmit={submitSearch} className="flex flex-wrap items-end gap-2">
                    <div className="grid gap-2">
                        <Label htmlFor="q">Search</Label>
                        <Input id="q" className="w-64" value={search} onChange={(e) => setSearch(e.target.value)} placeholder="Text or commenter" />
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="status">Status</Label>
                        <select id="status" className={selectClass} value={filters.status ?? ''} onChange={(e) => go({ status: (e.target.value || null) as Filters['status'] })}>
                            {STATUS_OPTIONS.map((o) => (
                                <option key={o.label} value={o.value ?? ''}>
                                    {o.label}
                                </option>
                            ))}
                        </select>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="target">On</Label>
                        <select id="target" className={selectClass} value={filters.target ?? ''} onChange={(e) => go({ target: (e.target.value || null) as Target | null })}>
                            <option value="">Anything</option>
                            {(Object.keys(TARGET_LABELS) as Target[]).map((t) => (
                                <option key={t} value={t}>
                                    {TARGET_LABELS[t]}
                                </option>
                            ))}
                        </select>
                    </div>
                    <Button type="submit">Search</Button>
                </form>
                <div className="overflow-x-auto">
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Comment</th>
                                <th className="py-2 pr-4">By</th>
                                <th className="py-2 pr-4">On</th>
                                <th className="py-2 pr-4">Status</th>
                                <th className="py-2 pr-4">Posted</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {comments.data.map((c) => (
                                <tr key={c.id} className={`border-b align-top ${c.deleted_at ? 'text-muted-foreground' : ''}`}>
                                    <td className="max-w-md py-2 pr-4">
                                        {c.is_reply && <span className="text-muted-foreground mr-1">Reply:</span>}
                                        <span className="line-clamp-3 whitespace-pre-wrap">{c.body}</span>
                                        {c.edited_at && <span className="text-muted-foreground text-xs"> (edited)</span>}
                                    </td>
                                    <td className="py-2 pr-4">
                                        {c.author ? (
                                            <a className="underline" href={`/admin/users/${c.author.id}`}>
                                                {c.author.name}
                                            </a>
                                        ) : (
                                            '(removed)'
                                        )}
                                        {c.author && <div className="text-muted-foreground text-xs">{c.author.role}</div>}
                                    </td>
                                    <td className="py-2 pr-4">
                                        <div className="text-muted-foreground text-xs">{TARGET_LABELS[c.target.type]}</div>
                                        {c.target.url ? (
                                            <a className="underline" href={c.target.url} target="_blank" rel="noreferrer">
                                                {c.target.title}
                                            </a>
                                        ) : (
                                            c.target.title
                                        )}
                                    </td>
                                    <td className="py-2 pr-4">{state(c)}</td>
                                    <td className="py-2 pr-4">{new Date(c.created_at).toLocaleString()}</td>
                                    <td className="py-2">
                                        <div className="flex flex-wrap gap-2">
                                            {!c.deleted_at && c.moderated && c.status !== 'approved' && (
                                                <Button variant="outline" size="sm" onClick={() => post(c, 'approve')}>
                                                    Approve
                                                </Button>
                                            )}
                                            {!c.deleted_at && c.moderated && c.status !== 'denied' && (
                                                <Button variant="outline" size="sm" onClick={() => post(c, 'deny')}>
                                                    Deny
                                                </Button>
                                            )}
                                            {!c.deleted_at && (
                                                <Button variant="destructive" size="sm" onClick={() => remove(c)}>
                                                    Delete
                                                </Button>
                                            )}
                                            {c.deleted_at && (
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    disabled={c.parent_deleted}
                                                    title={c.parent_deleted ? 'Restore the comment it replies to first.' : undefined}
                                                    onClick={() => post(c, 'restore')}
                                                >
                                                    Restore
                                                </Button>
                                            )}
                                        </div>
                                    </td>
                                </tr>
                            ))}
                            {comments.data.length === 0 && (
                                <tr>
                                    <td className="py-4" colSpan={6}>
                                        No comments match.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
                <div className="flex gap-2">
                    <Button variant="outline" disabled={!comments.prev_page_url} onClick={() => comments.prev_page_url && router.get(comments.prev_page_url)}>
                        Previous
                    </Button>
                    <span className="self-center text-sm">
                        Page {comments.current_page} of {comments.last_page}
                    </span>
                    <Button variant="outline" disabled={!comments.next_page_url} onClick={() => comments.next_page_url && router.get(comments.next_page_url)}>
                        Next
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
