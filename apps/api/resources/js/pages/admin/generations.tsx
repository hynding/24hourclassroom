import { type BreadcrumbItem } from '@/types';
import { type AdminGenerationRow, type GenerationFilters, type Paginated } from '@/types/admin';
import { Head, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { formatCents, formatDuration, formatWhen } from '@/lib/admin-format';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/generations' }];

const SELECT_CLASS =
    'border-input bg-background h-9 w-48 rounded-md border px-3 text-sm shadow-xs focus-visible:ring-ring/50 focus-visible:ring-[3px] outline-none';

type Props = {
    generations: Paginated<AdminGenerationRow>;
    filters: GenerationFilters;
    statuses: string[];
    notice: string | null;
};

export default function AdminGenerations({ generations, filters, statuses, notice }: Props) {
    const [status, setStatus] = useState(filters.status ?? '');
    const [user, setUser] = useState(filters.user === null ? '' : String(filters.user));
    const [leftovers, setLeftovers] = useState(filters.leftovers);

    const apply: FormEventHandler = (e) => {
        e.preventDefault();

        // The checkbox is Radix, not a native input, so it never submits "on":
        // `1` or absent is what the server's `boolean` rule accepts.
        router.get(
            '/admin/generations',
            { status: status || undefined, user: user || undefined, leftovers: leftovers ? 1 : undefined },
            { preserveState: true, replace: true },
        );
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: generations" />

            <div className="space-y-6 px-4 py-6">
                <HeadingSmall
                    title="Generations"
                    description="Every AI test-generation run, newest first. Cancel a stuck run or retry a cleanup that gave up."
                />

                <form onSubmit={apply} className="flex flex-wrap items-end gap-3">
                    <div className="grid gap-2">
                        <Label htmlFor="status">Status</Label>
                        <select id="status" className={SELECT_CLASS} value={status} onChange={(e) => setStatus(e.target.value)}>
                            <option value="">Any</option>
                            <option value="live">Live</option>
                            {statuses.map((s) => (
                                <option key={s} value={s}>
                                    {s}
                                </option>
                            ))}
                        </select>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="user">Teacher id</Label>
                        <Input id="user" type="number" min={1} className="w-32" value={user} onChange={(e) => setUser(e.target.value)} />
                    </div>
                    <div className="flex h-9 items-center gap-2">
                        <Checkbox id="leftovers" checked={leftovers} onCheckedChange={(checked) => setLeftovers(checked === true)} />
                        <Label htmlFor="leftovers">Leftovers only</Label>
                    </div>
                    <Button type="submit">Apply</Button>
                </form>

                {notice && <p className="text-muted-foreground text-sm">{notice}</p>}

                <div className="overflow-x-auto">
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">#</th>
                                <th className="py-2 pr-4">Teacher</th>
                                <th className="py-2 pr-4">Title</th>
                                <th className="py-2 pr-4">Subject / grade</th>
                                <th className="py-2 pr-4">Status</th>
                                <th className="py-2 pr-4">Cost</th>
                                <th className="py-2 pr-4">Started</th>
                                <th className="py-2 pr-4">Duration</th>
                                <th className="py-2 pr-4">Leftovers</th>
                            </tr>
                        </thead>
                        <tbody>
                            {generations.data.map((row) => (
                                <tr key={row.id} className="border-b">
                                    <td className="py-2 pr-4">{row.id}</td>
                                    <td className="py-2 pr-4">{row.user.name}</td>
                                    <td className="py-2 pr-4">{row.title}</td>
                                    <td className="py-2 pr-4">
                                        {row.subject} / {row.grade_level}
                                    </td>
                                    <td className="py-2 pr-4">{row.status}</td>
                                    <td className="py-2 pr-4">{formatCents(row.list_cost_cents)}</td>
                                    <td className="py-2 pr-4">{row.started_at ? formatWhen(row.started_at) : ''}</td>
                                    <td className="py-2 pr-4">{formatDuration(row.duration_seconds)}</td>
                                    <td className="py-2 pr-4">{row.has_leftovers ? 'Yes' : ''}</td>
                                </tr>
                            ))}
                            {generations.data.length === 0 && (
                                <tr>
                                    <td className="py-4" colSpan={9}>
                                        No generations match.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>

                <div className="flex items-center gap-2">
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        disabled={!generations.prev_page_url}
                        onClick={() => generations.prev_page_url && router.get(generations.prev_page_url, {}, { preserveState: true })}
                    >
                        Previous
                    </Button>
                    <span className="text-muted-foreground text-sm">
                        Page {generations.current_page} of {generations.last_page}
                    </span>
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        disabled={!generations.next_page_url}
                        onClick={() => generations.next_page_url && router.get(generations.next_page_url, {}, { preserveState: true })}
                    >
                        Next
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
