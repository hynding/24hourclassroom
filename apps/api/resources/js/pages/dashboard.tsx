import { type BreadcrumbItem } from '@/types';
import { type AdminMetrics, type CostWindow } from '@/types/admin';
import { Head, Link } from '@inertiajs/react';
import { type ReactNode } from 'react';

import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { formatCents } from '@/lib/admin-format';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ metrics }: { metrics: AdminMetrics | null }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">{metrics ? <AdminOverview metrics={metrics} /> : <Placeholders />}</div>
        </AppLayout>
    );
}

function Card({ title, children }: { title: string; children: ReactNode }) {
    return (
        <section className="border-sidebar-border/70 dark:border-sidebar-border rounded-xl border p-4 text-sm">
            <h2 className="mb-2 font-medium">{title}</h2>
            {children}
        </section>
    );
}

function Stat({ label, value }: { label: string; value: ReactNode }) {
    return (
        <li className="flex justify-between gap-4">
            <span className="text-muted-foreground">{label}</span>
            <span>{value}</span>
        </li>
    );
}

/** Each window annotates its OWN unpriced count (spec decision 8). */
function cost({ cents, unpriced }: CostWindow): string {
    return unpriced > 0 ? `${formatCents(cents)} (+${unpriced} unpriced)` : formatCents(cents);
}

function AdminOverview({ metrics }: { metrics: AdminMetrics }) {
    const { people, content, generations, recent_users } = metrics;

    return (
        <div className="grid auto-rows-min gap-4 md:grid-cols-2 xl:grid-cols-4">
            <Card title="People">
                <ul className="space-y-1">
                    <Stat label="Teachers" value={people.by_role.teacher} />
                    <Stat label="Students" value={people.by_role.student} />
                    <Stat label="Admins" value={people.by_role.admin} />
                    <Stat label="Verified" value={`${people.verified_percentage}%`} />
                    <Stat label="New, 7 days" value={people.new_7d} />
                    <Stat label="New, 30 days" value={people.new_30d} />
                    <Stat label="Unverified over 7 days" value={people.unverified_7d_plus} />
                    <Stat label="Follows" value={people.follows} />
                    <Stat label="Connections" value={people.connections} />
                </ul>
            </Card>

            <Card title="Content">
                <ul className="space-y-1">
                    <Stat label="Tests, public / private" value={`${content.tests.public} / ${content.tests.private}`} />
                    <Stat label="Tests published, 30 days" value={content.tests.published_30d} />
                    <Stat label="Materials, public / private" value={`${content.materials.public} / ${content.materials.private}`} />
                    <Stat label="Materials published, 30 days" value={content.materials.published_30d} />
                </ul>
            </Card>

            <Card title="Generations">
                <ul className="space-y-1">
                    <Stat label="Live" value={generations.live} />
                    {Object.entries(generations.by_status).map(([status, count]) => (
                        <Stat key={status} label={status} value={count} />
                    ))}
                    <Stat label="Cost, 30 days" value={cost(generations.cost_30d)} />
                    <Stat label="Cost, all time" value={cost(generations.cost_all)} />
                </ul>
                {generations.leftovers > 0 && (
                    <p className="mt-2">
                        <Link href="/admin/generations?leftovers=1" className="underline">
                            {generations.leftovers} finished {generations.leftovers === 1 ? 'run' : 'runs'} with leftovers
                        </Link>
                    </p>
                )}
            </Card>

            <Card title="Recent sign-ups">
                <ul className="space-y-1">
                    {recent_users.map((user) => (
                        <li key={user.id} className="flex justify-between gap-4">
                            <Link href={`/admin/users?q=${encodeURIComponent(user.email)}`} className="underline">
                                {user.name}
                            </Link>
                            <span className="text-muted-foreground">
                                {user.role}
                                {user.verified ? '' : ', unverified'}
                            </span>
                        </li>
                    ))}
                    {recent_users.length === 0 && <li className="text-muted-foreground">No users yet.</li>}
                </ul>
            </Card>
        </div>
    );
}

/** What every non-admin sees: the starter kit's tiles, unchanged. */
function Placeholders() {
    return (
        <>
            <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
            </div>
            <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
            </div>
        </>
    );
}
