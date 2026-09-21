import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/materials' }];

type AdminMaterial = {
    id: number;
    title: string;
    author: { id: number; name: string };
    subject: string;
    grade_level: string;
    size_bytes: number;
    published_at: string | null;
};

type Paginated<T> = { data: T[]; current_page: number; last_page: number; prev_page_url: string | null; next_page_url: string | null };

// Binary units labelled KB/MB, so the 10,485,760-byte cap reads "10 MB" and
// matches the server's message.
function formatBytes(bytes: number): string {
    if (bytes < 1024) return `${bytes} B`;
    if (bytes < 1048576) return `${(bytes / 1024).toFixed(1)} KB`;
    return `${(bytes / 1048576).toFixed(1)} MB`;
}

export default function AdminMaterials({ materials, filters }: { materials: Paginated<AdminMaterial>; filters: { q: string | null } }) {
    const [search, setSearch] = useState(filters.q ?? '');

    const submitSearch: FormEventHandler = (e) => {
        e.preventDefault();
        router.get('/admin/materials', { q: search || undefined }, { preserveState: true, replace: true });
    };

    const unpublish = (material: AdminMaterial) => {
        if (confirm(`Unpublish "${material.title}"? The author will be notified.`)) {
            router.post(`/admin/materials/${material.id}/unpublish`, {}, { preserveScroll: true });
        }
    };

    const remove = (material: AdminMaterial) => {
        if (confirm(`Delete "${material.title}", its shares and its file? This cannot be undone.`)) {
            router.delete(`/admin/materials/${material.id}`, { preserveScroll: true });
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: materials" />
            <div className="space-y-6 px-4 py-6">
                <HeadingSmall title="Public materials" description="Unpublish or delete materials that do not meet the guidelines." />
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
                                <th className="py-2 pr-4">Size</th>
                                <th className="py-2 pr-4">Published</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {materials.data.map((material) => (
                                <tr key={material.id} className="border-b">
                                    <td className="py-2 pr-4">{material.title}</td>
                                    <td className="py-2 pr-4">{material.author.name}</td>
                                    <td className="py-2 pr-4">{material.subject}</td>
                                    <td className="py-2 pr-4">{material.grade_level}</td>
                                    <td className="py-2 pr-4">{formatBytes(material.size_bytes)}</td>
                                    <td className="py-2 pr-4">{material.published_at ? new Date(material.published_at).toLocaleDateString() : ''}</td>
                                    <td className="flex gap-2 py-2">
                                        <Button variant="outline" size="sm" onClick={() => unpublish(material)}>
                                            Unpublish
                                        </Button>
                                        <Button variant="destructive" size="sm" onClick={() => remove(material)}>
                                            Delete
                                        </Button>
                                    </td>
                                </tr>
                            ))}
                            {materials.data.length === 0 && (
                                <tr>
                                    <td className="py-4" colSpan={7}>
                                        No public materials match.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
                <div className="flex gap-2">
                    <Button
                        variant="outline"
                        disabled={!materials.prev_page_url}
                        onClick={() => materials.prev_page_url && router.get(materials.prev_page_url)}
                    >
                        Previous
                    </Button>
                    <span className="self-center text-sm">
                        Page {materials.current_page} of {materials.last_page}
                    </span>
                    <Button
                        variant="outline"
                        disabled={!materials.next_page_url}
                        onClick={() => materials.next_page_url && router.get(materials.next_page_url)}
                    >
                        Next
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
