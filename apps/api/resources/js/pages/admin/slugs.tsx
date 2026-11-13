import { type BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/slugs' }];

type SlugRow = {
    id: number;
    kind: 'teacher' | 'teacher_course' | 'site_course';
    slug: string;
    status: 'pending' | 'approved' | 'rejected' | 'retired';
    user: { id: number; name: string; email: string } | null;
    course: { id: number; title: string } | null;
    created_at: string;
    reviewed_at: string | null;
};

type Props = { spa_origin: string; pending: SlugRow[]; handles: SlugRow[]; site: SlugRow[] };

export default function AdminSlugs({ spa_origin, pending, handles, site }: Props) {
    const { errors } = usePage().props as { errors: Record<string, string> };
    const [courseId, setCourseId] = useState('');
    const [slug, setSlug] = useState('');

    const approve = (row: SlugRow) => router.post(`/admin/slugs/${row.id}/approve`, {}, { preserveScroll: true });
    const reject = (row: SlugRow) => {
        if (confirm(`Decline the handle "${row.slug}"? Nobody will be able to use it.`)) {
            router.post(`/admin/slugs/${row.id}/reject`, {}, { preserveScroll: true });
        }
    };
    const setSiteSlug: FormEventHandler = (e) => {
        e.preventDefault();
        router.put('/admin/slugs/site-course', { course_id: Number(courseId), slug: slug || null }, {
            preserveScroll: true,
            onSuccess: () => { setCourseId(''); setSlug(''); },
        });
    };
    const retire = (row: SlugRow) => {
        if (row.course && confirm(`Retire ${spa_origin}/courses/${row.slug}? Old links keep redirecting to the course, and the address is never reissued.`)) {
            router.put('/admin/slugs/site-course', { course_id: row.course.id, slug: null }, { preserveScroll: true });
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: addresses" />
            <div className="space-y-10 px-4 py-6">
                <section className="space-y-4">
                    <HeadingSmall
                        title="Handle requests"
                        description="A teacher's handle gives them /teachers/<handle>. Once it is approved, the course addresses they set under it go live without review."
                    />
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Handle</th>
                                <th className="py-2 pr-4">Teacher</th>
                                <th className="py-2 pr-4">Requested</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {pending.map((row) => (
                                <tr key={row.id} className="border-b">
                                    <td className="py-2 pr-4 font-mono">/teachers/{row.slug}</td>
                                    <td className="py-2 pr-4">{row.user ? `${row.user.name} (${row.user.email})` : ''}</td>
                                    <td className="py-2 pr-4">{new Date(row.created_at).toLocaleDateString()}</td>
                                    <td className="flex gap-2 py-2">
                                        <Button size="sm" onClick={() => approve(row)}>Approve</Button>
                                        <Button variant="outline" size="sm" onClick={() => reject(row)}>Decline</Button>
                                    </td>
                                </tr>
                            ))}
                            {pending.length === 0 && (
                                <tr><td className="py-4" colSpan={4}>No handles are waiting.</td></tr>
                            )}
                        </tbody>
                    </table>
                </section>

                <section className="space-y-4">
                    <HeadingSmall title="Course addresses" description="Site-wide /courses/<name> addresses, set here only. A replaced or retired address keeps redirecting and is never reissued." />
                    <form onSubmit={setSiteSlug} className="flex flex-wrap items-end gap-2">
                        <div className="grid gap-2">
                            <Label htmlFor="course_id">Course id</Label>
                            <Input id="course_id" className="w-32" inputMode="numeric" value={courseId} onChange={(e) => setCourseId(e.target.value)} />
                            <InputError message={errors.course_id} />
                        </div>
                        <div className="grid gap-2">
                            <Label htmlFor="slug">Address</Label>
                            <Input id="slug" className="w-64" value={slug} onChange={(e) => setSlug(e.target.value)} placeholder="precalculus" />
                            <InputError message={errors.slug} />
                        </div>
                        <Button type="submit" disabled={courseId === '' || slug === ''}>Set address</Button>
                    </form>
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Address</th>
                                <th className="py-2 pr-4">Course</th>
                                <th className="py-2 pr-4">Status</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {site.map((row) => (
                                <tr key={row.id} className="border-b">
                                    <td className="py-2 pr-4 font-mono">/courses/{row.slug}</td>
                                    <td className="py-2 pr-4">{row.course ? `${row.course.title} (#${row.course.id})` : ''}</td>
                                    <td className="py-2 pr-4">{row.status === 'retired' ? 'Retired (redirects)' : 'Live'}</td>
                                    <td className="py-2">
                                        {row.status === 'approved' && (
                                            <Button variant="outline" size="sm" onClick={() => retire(row)}>Retire</Button>
                                        )}
                                    </td>
                                </tr>
                            ))}
                            {site.length === 0 && (
                                <tr><td className="py-4" colSpan={4}>No course addresses yet.</td></tr>
                            )}
                        </tbody>
                    </table>
                </section>

                <section className="space-y-4">
                    <HeadingSmall title="Approved handles" />
                    <ul className="space-y-1 text-sm">
                        {handles.map((row) => (
                            <li key={row.id}>
                                <span className="font-mono">/teachers/{row.slug}</span> {row.user ? `— ${row.user.name}` : ''}
                            </li>
                        ))}
                        {handles.length === 0 && <li>None yet.</li>}
                    </ul>
                </section>
            </div>
        </AppLayout>
    );
}
