import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/courses' }];

type AdminCourse = {
    id: number;
    title: string;
    subject: string;
    grade_level: string;
    author: { id: number; name: string };
    item_count: number;
    published_at: string | null;
};

type Paginated<T> = { data: T[]; current_page: number; last_page: number; prev_page_url: string | null; next_page_url: string | null };

export default function AdminCourses({ courses, filters }: { courses: Paginated<AdminCourse>; filters: { q: string | null } }) {
    const [search, setSearch] = useState(filters.q ?? '');

    const submitSearch: FormEventHandler = (e) => {
        e.preventDefault();
        router.get('/admin/courses', { q: search || undefined }, { preserveState: true, replace: true });
    };

    const unpublish = (course: AdminCourse) => {
        if (confirm(`Unpublish "${course.title}"? The author will be notified.`)) {
            router.post(`/admin/courses/${course.id}/unpublish`, {}, { preserveScroll: true });
        }
    };

    const remove = (course: AdminCourse) => {
        if (confirm(`Delete the course "${course.title}"? Its tests and materials are kept. This cannot be undone.`)) {
            router.delete(`/admin/courses/${course.id}`, { preserveScroll: true });
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: courses" />
            <div className="space-y-6 px-4 py-6">
                <HeadingSmall title="Public courses" description="Unpublish or delete courses that do not meet the guidelines." />
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
                                <th className="py-2 pr-4">Items</th>
                                <th className="py-2 pr-4">Published</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {courses.data.map((course) => (
                                <tr key={course.id} className="border-b">
                                    <td className="py-2 pr-4">{course.title}</td>
                                    <td className="py-2 pr-4">{course.author.name}</td>
                                    <td className="py-2 pr-4">{course.subject}</td>
                                    <td className="py-2 pr-4">{course.grade_level}</td>
                                    <td className="py-2 pr-4">{course.item_count}</td>
                                    <td className="py-2 pr-4">{course.published_at ? new Date(course.published_at).toLocaleDateString() : ''}</td>
                                    <td className="flex gap-2 py-2">
                                        <Button variant="outline" size="sm" onClick={() => unpublish(course)}>
                                            Unpublish
                                        </Button>
                                        <Button variant="destructive" size="sm" onClick={() => remove(course)}>
                                            Delete
                                        </Button>
                                    </td>
                                </tr>
                            ))}
                            {courses.data.length === 0 && (
                                <tr>
                                    <td className="py-4" colSpan={7}>
                                        No public courses match.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
                <div className="flex gap-2">
                    <Button variant="outline" disabled={!courses.prev_page_url} onClick={() => courses.prev_page_url && router.get(courses.prev_page_url)}>
                        Previous
                    </Button>
                    <span className="self-center text-sm">
                        Page {courses.current_page} of {courses.last_page}
                    </span>
                    <Button variant="outline" disabled={!courses.next_page_url} onClick={() => courses.next_page_url && router.get(courses.next_page_url)}>
                        Next
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
