import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

import HeadingSmall from '@/components/heading-small';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Admin', href: '/admin/analytics' }];

type Count = { key: string; count: number };
type Day = { day: string; views: number; visits: number; signups: number };
type CourseRow = { id: number; title: string; author: string | null; public: boolean; views: number; practice_checks: number; branches: number };

type Props = {
    days: number;
    ranges: number[];
    spa_origin: string;
    totals: { views: number; visits: number; signups: number; practice_checks: number; branches: number };
    daily: Day[];
    pages: Count[];
    referrers: Count[];
    sources: Count[];
    signups_by_role: Count[];
    courses: CourseRow[];
};

const fmt = (n: number) => n.toLocaleString();

function CountTable({
    title,
    description,
    rows,
    label,
    empty,
    render,
}: {
    title: string;
    description: string;
    rows: Count[];
    label: string;
    empty: string;
    render?: (key: string) => React.ReactNode;
}) {
    return (
        <section className="space-y-3">
            <HeadingSmall title={title} description={description} />
            <table className="w-full text-left text-sm">
                <thead>
                    <tr className="border-b">
                        <th className="py-2 pr-4">{label}</th>
                        <th className="py-2 text-right">Count</th>
                    </tr>
                </thead>
                <tbody>
                    {rows.map((row) => (
                        <tr key={row.key} className="border-b">
                            <td className="py-2 pr-4 break-all">{render ? render(row.key) : row.key || '(none)'}</td>
                            <td className="py-2 text-right tabular-nums">{fmt(row.count)}</td>
                        </tr>
                    ))}
                    {rows.length === 0 && (
                        <tr>
                            <td className="text-muted-foreground py-3" colSpan={2}>
                                {empty}
                            </td>
                        </tr>
                    )}
                </tbody>
            </table>
        </section>
    );
}

export default function AdminAnalytics({ days, ranges, spa_origin, totals, daily, pages, referrers, sources, signups_by_role, courses }: Props) {
    const peak = Math.max(1, ...daily.map((d) => d.views));
    const tiles: [string, number][] = [
        ['Page views', totals.views],
        ['Visits', totals.visits],
        ['Sign-ups', totals.signups],
        ['Practice runs checked', totals.practice_checks],
        ['Courses branched', totals.branches],
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: analytics" />
            <div className="space-y-10 px-4 py-6">
                <section className="space-y-4">
                    <HeadingSmall
                        title="Usage"
                        description="Daily counts only. No cookies, IP addresses, user ids or visitor ids are stored, and bots are skipped, so nothing here can be traced to a person. A visit is the first page opened in a browser tab."
                    />
                    <nav className="flex gap-2 text-sm" aria-label="Date range">
                        {ranges.map((r) => (
                            <Link
                                key={r}
                                href={`/admin/analytics?days=${r}`}
                                className={r === days ? 'rounded border px-3 py-1 font-semibold' : 'rounded px-3 py-1 underline'}
                                aria-current={r === days ? 'page' : undefined}
                            >
                                Last {r} days
                            </Link>
                        ))}
                    </nav>
                    <dl className="grid grid-cols-2 gap-4 sm:grid-cols-5">
                        {tiles.map(([label, value]) => (
                            <div key={label} className="rounded border p-3">
                                <dt className="text-muted-foreground text-xs">{label}</dt>
                                <dd className="text-2xl font-semibold tabular-nums">{fmt(value)}</dd>
                            </div>
                        ))}
                    </dl>
                </section>

                <section className="space-y-3">
                    <HeadingSmall title="By day" description="Page views (bar), visits and sign-ups for each day, newest first." />
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Day</th>
                                <th className="w-1/2 py-2 pr-4">Page views</th>
                                <th className="py-2 pr-4 text-right">Visits</th>
                                <th className="py-2 text-right">Sign-ups</th>
                            </tr>
                        </thead>
                        <tbody>
                            {[...daily].reverse().map((d) => (
                                <tr key={d.day} className="border-b">
                                    <td className="py-1 pr-4 whitespace-nowrap">{d.day}</td>
                                    <td className="py-1 pr-4">
                                        <div className="flex items-center gap-2">
                                            <div className="bg-primary h-3 rounded-sm" style={{ width: `${(d.views / peak) * 100}%` }} aria-hidden />
                                            <span className="tabular-nums">{fmt(d.views)}</span>
                                        </div>
                                    </td>
                                    <td className="py-1 pr-4 text-right tabular-nums">{fmt(d.visits)}</td>
                                    <td className="py-1 text-right tabular-nums">{fmt(d.signups)}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </section>

                <section className="space-y-3">
                    <HeadingSmall
                        title="Courses"
                        description="Views of a course's page and practice tests at any of its addresses, finished practice runs (Check answers) and branches by other teachers."
                    />
                    <table className="w-full text-left text-sm">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 pr-4">Course</th>
                                <th className="py-2 pr-4">Author</th>
                                <th className="py-2 pr-4 text-right">Views</th>
                                <th className="py-2 pr-4 text-right">Practice runs</th>
                                <th className="py-2 text-right">Branches</th>
                            </tr>
                        </thead>
                        <tbody>
                            {courses.map((c) => (
                                <tr key={c.id} className="border-b">
                                    <td className="py-2 pr-4">
                                        <a href={`${spa_origin}/courses/${c.id}`} className="underline">
                                            {c.title}
                                        </a>
                                        {!c.public && <span className="text-muted-foreground"> (private)</span>}
                                    </td>
                                    <td className="py-2 pr-4">{c.author ?? ''}</td>
                                    <td className="py-2 pr-4 text-right tabular-nums">{fmt(c.views)}</td>
                                    <td className="py-2 pr-4 text-right tabular-nums">{fmt(c.practice_checks)}</td>
                                    <td className="py-2 text-right tabular-nums">{fmt(c.branches)}</td>
                                </tr>
                            ))}
                            {courses.length === 0 && (
                                <tr>
                                    <td className="text-muted-foreground py-3" colSpan={5}>
                                        No course activity in this range.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </section>

                <div className="grid gap-10 lg:grid-cols-2">
                    <CountTable
                        title="Top pages"
                        description="The 25 most viewed. Private pages are counted by kind (/attempts/:id), never by record."
                        rows={pages}
                        label="Page"
                        empty="No page views in this range."
                    />
                    <div className="space-y-10">
                        <CountTable
                            title="Referring sites"
                            description="Where visits came from: the site only, never the full address."
                            rows={referrers}
                            label="Site"
                            empty="No referred visits in this range."
                        />
                        <CountTable
                            title="Campaigns"
                            description="utm_source on the first page of a visit, for links you share (?utm_source=apbio-group)."
                            rows={sources}
                            label="Source"
                            empty="No tagged visits in this range."
                        />
                        <CountTable
                            title="Sign-ups by role"
                            description="New accounts in this range."
                            rows={signups_by_role}
                            label="Role"
                            empty="No sign-ups in this range."
                        />
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
