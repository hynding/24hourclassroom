import { type BreadcrumbItem } from '@/types';
import { type AdminGenerationDetail } from '@/types/admin';
import { Head, Link } from '@inertiajs/react';
import { Fragment, type ReactNode } from 'react';

import { GenerationActions } from '@/components/generation-actions';
import HeadingSmall from '@/components/heading-small';
import AppLayout from '@/layouts/app-layout';
import { formatCents, formatDuration, formatWhen } from '@/lib/admin-format';

type Props = { generation: AdminGenerationDetail; notice: string | null };

export default function AdminGeneration({ generation, notice }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: '/admin/generations' },
        { title: 'Generations', href: '/admin/generations' },
        { title: `#${generation.id}`, href: `/admin/generations/${generation.id}` },
    ];

    const fields: [string, ReactNode][] = [
        [
            'Teacher',
            <>
                <Link href={`/admin/generations?user=${generation.user.id}`} className="underline">
                    {generation.user.name}
                </Link>{' '}
                (
                <Link href={`/admin/users/${generation.user.id}`} className="underline">
                    {generation.user.email}
                </Link>
                )
            </>,
        ],
        ['Title', generation.title],
        ['Subject / grade', `${generation.subject} / ${generation.grade_level}`],
        ['Status', generation.status],
        ['Cost', formatCents(generation.list_cost_cents)],
        ['Created', formatWhen(generation.created_at)],
        ['Started', formatWhen(generation.started_at)],
        ['Finished', formatWhen(generation.finished_at)],
        ['Duration', formatDuration(generation.duration_seconds) || '—'],
        ['Session', generation.session_id ?? '—'],
        ['Archived', formatWhen(generation.archived_at)],
        ['File ids', generation.file_ids?.join(', ') ?? '—'],
        ['Material ids', generation.material_ids.join(', ') || '—'],
        ['Tool failures', String(generation.tool_failures)],
        ['Teardown attempts', String(generation.teardown_attempts)],
        ['Leftovers', generation.has_leftovers ? 'Yes' : 'No'],
        ['Saved test', generation.test ? `#${generation.test.id} ${generation.test.title}` : '—'],
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Admin: generation #${generation.id}`} />

            <div className="space-y-6 px-4 py-6">
                <HeadingSmall title={generation.title} description={`Generation #${generation.id}`} />

                {notice && <p className="text-muted-foreground text-sm">{notice}</p>}

                <dl className="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-2 text-sm">
                    {fields.map(([label, value]) => (
                        <Fragment key={label}>
                            <dt className="text-muted-foreground">{label}</dt>
                            <dd>{value}</dd>
                        </Fragment>
                    ))}
                </dl>

                {!generation.owner_has_key && generation.has_leftovers && (
                    <p className="text-sm">
                        The owner has no API key, so a retry cannot delete files or archive the session; it only spends an attempt.
                    </p>
                )}

                <GenerationActions id={generation.id} title={generation.title} live={generation.live} hasLeftovers={generation.has_leftovers} />

                {generation.instructions && (
                    <section className="space-y-1">
                        <h3 className="font-medium">Instructions</h3>
                        <pre className="text-sm whitespace-pre-wrap">{generation.instructions}</pre>
                    </section>
                )}
                {generation.error && (
                    <section className="space-y-1">
                        <h3 className="font-medium">Error</h3>
                        <pre className="text-sm whitespace-pre-wrap">{generation.error}</pre>
                    </section>
                )}
                {generation.agent_note && (
                    <section className="space-y-1">
                        <h3 className="font-medium">Agent note</h3>
                        <pre className="text-sm whitespace-pre-wrap">{generation.agent_note}</pre>
                    </section>
                )}
            </div>
        </AppLayout>
    );
}
