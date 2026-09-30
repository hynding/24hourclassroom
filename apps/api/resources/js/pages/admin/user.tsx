import { type BreadcrumbItem } from '@/types';
import { type AdminRelated, type AdminUserDetail } from '@/types/admin';
import { Head, Link } from '@inertiajs/react';
import { Fragment, type ReactNode } from 'react';

import { ConfirmButton } from '@/components/confirm-button';
import HeadingSmall from '@/components/heading-small';
import { Separator } from '@/components/ui/separator';
import AppLayout from '@/layouts/app-layout';
import { formatBytes, formatCents, formatDuration, formatWhen } from '@/lib/admin-format';

type Props = { detail: AdminUserDetail; notice: string | null };

function Section({ title, children }: { title: string; children: ReactNode }) {
    return (
        <section className="space-y-2">
            <h2 className="font-medium">{title}</h2>
            {children}
        </section>
    );
}

function Definitions({ rows }: { rows: [string, ReactNode][] }) {
    return (
        <dl className="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-2 text-sm">
            {rows.map(([label, value]) => (
                <Fragment key={label}>
                    <dt className="text-muted-foreground">{label}</dt>
                    <dd>{value}</dd>
                </Fragment>
            ))}
        </dl>
    );
}

function RelatedLink({ user }: { user: AdminRelated }) {
    return (
        <Link href={`/admin/users/${user.id}`} className="underline">
            {user.name}
        </Link>
    );
}

const TABLE = 'w-full text-left text-sm';
const TH = 'py-2 pr-4';
const TD = 'py-2 pr-4';

export default function AdminUser({ detail, notice }: Props) {
    const { user, profile, integration, counts } = detail;
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: '/admin/users' },
        { title: 'Users', href: '/admin/users' },
        { title: user.name, href: `/admin/users/${user.id}` },
    ];
    const userUrl = `/admin/users/${user.id}`;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Admin: ${user.name}`} />

            <div className="space-y-8 px-4 py-6">
                <HeadingSmall title={user.name} description={user.email} />

                {notice && <p className="text-muted-foreground text-sm">{notice}</p>}

                <Definitions
                    rows={[
                        ['Role', user.role],
                        ['Email', user.email_verified_at ? `verified ${formatWhen(user.email_verified_at)}` : 'unverified'],
                        ['Status', user.deactivated_at ? `deactivated ${formatWhen(user.deactivated_at)}` : 'active'],
                        ['Google', user.google_linked ? 'linked' : 'not linked'],
                        ['Joined', formatWhen(user.created_at)],
                    ]}
                />

                <Section title="Actions">
                    {!user.actionable ? (
                        <p className="text-sm">
                            {user.is_self ? 'This is your own account.' : 'Admin accounts are managed from the shell (user:promote, user:demote).'}
                        </p>
                    ) : (
                        <div className="space-y-3">
                            <div className="flex flex-wrap gap-2">
                                {user.role_options.map((role) => (
                                    <ConfirmButton
                                        key={role}
                                        label={`Make ${role}`}
                                        method="patch"
                                        url={`${userUrl}/role`}
                                        data={{ role }}
                                        confirm={`Change ${user.name} to ${role}?`}
                                    />
                                ))}
                                {user.deactivated_at ? (
                                    <ConfirmButton
                                        label="Reactivate"
                                        method="patch"
                                        url={`${userUrl}/reactivate`}
                                        confirm={`Reactivate ${user.name}?`}
                                    />
                                ) : (
                                    <ConfirmButton
                                        label="Deactivate"
                                        method="patch"
                                        url={`${userUrl}/deactivate`}
                                        confirm={`Deactivate ${user.name}? They will be signed out and cannot sign in until reactivated.`}
                                    />
                                )}
                                {/* verification actions */}
                                <ConfirmButton
                                    label="Clear profile content"
                                    variant="destructive"
                                    method="delete"
                                    url={`${userUrl}/profile-content`}
                                    confirm={`Clear ${user.name}'s bio, specialties and avatar? They will be notified.`}
                                />
                                {/* key action */}
                            </div>
                            {/* delete block */}
                        </div>
                    )}
                </Section>

                <Section title="Profile">
                    {profile ? (
                        <div className="flex gap-6">
                            {profile.avatar_url && <img src={profile.avatar_url} alt="" className="size-16 rounded-full" />}
                            <Definitions
                                rows={[
                                    ['Bio', profile.bio ?? '—'],
                                    ['School', profile.school ?? '—'],
                                    ['Specialties', profile.specialties ?? '—'],
                                    ['Subjects', profile.subjects.join(', ') || '—'],
                                    ['Grade levels', profile.grade_levels.join(', ') || '—'],
                                ]}
                            />
                        </div>
                    ) : (
                        <p className="text-muted-foreground text-sm">No profile yet.</p>
                    )}
                </Section>

                <Section title="Integration">
                    {integration === null ? (
                        <p className="text-muted-foreground text-sm">No Anthropic integration.</p>
                    ) : (
                        <div className="space-y-1 text-sm">
                            <p>
                                {integration.has_key
                                    ? `Key ending in ${integration.key_hint}, verified ${formatWhen(integration.key_verified_at)}`
                                    : 'No key.'}
                            </p>
                            <p>Provisioned: {integration.provisioned ? 'yes' : 'no'}</p>
                            {!integration.has_key && integration.provisioned && (
                                <p>Their Anthropic environment and agent are still provisioned and cannot be archived without a key.</p>
                            )}
                        </div>
                    )}
                </Section>

                <Section title="Activity">
                    <Definitions
                        rows={[
                            ...Object.entries(counts.tests).map(([visibility, n]): [string, ReactNode] => [`Tests, ${visibility}`, n]),
                            ...Object.entries(counts.materials).map(([visibility, n]): [string, ReactNode] => [`Materials, ${visibility}`, n]),
                            ['Generations, live / total', `${counts.generations_live} / ${counts.generations_total}`],
                            ['Attempts taken', counts.attempts_taken],
                            ['Attempts received', counts.attempts_received],
                            ['Assignments', counts.assignments],
                            ['Material shares out', counts.shares_out],
                            ['MCP tokens', counts.tokens],
                        ]}
                    />
                </Section>

                <Section title="Connections">
                    <table className={TABLE}>
                        <thead>
                            <tr className="border-b">
                                <th className={TH}>With</th>
                                <th className={TH}>Status</th>
                                <th className={TH}>Since</th>
                                <th className="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {detail.connections.map((c) => (
                                <tr key={c.id} className="border-b">
                                    <td className={TD}>
                                        <RelatedLink user={c.counterpart} /> ({c.counterpart.role})
                                    </td>
                                    <td className={TD}>{c.status}</td>
                                    <td className={TD}>{formatWhen(c.created_at)}</td>
                                    <td className="py-2">{/* connection remove */}</td>
                                </tr>
                            ))}
                            {detail.connections.length === 0 && (
                                <tr>
                                    <td className="py-2" colSpan={4}>
                                        No connections.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </Section>

                {(['following', 'followers'] as const).map((direction) => (
                    <Section key={direction} title={direction === 'following' ? 'Following' : 'Followers'}>
                        <table className={TABLE}>
                            <thead>
                                <tr className="border-b">
                                    <th className={TH}>User</th>
                                    <th className="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {detail[direction].map((f) => (
                                    <tr key={f.follow_id} className="border-b">
                                        <td className={TD}>
                                            <RelatedLink user={f.user} /> ({f.user.role})
                                        </td>
                                        <td className="py-2">{/* follow remove */}</td>
                                    </tr>
                                ))}
                                {detail[direction].length === 0 && (
                                    <tr>
                                        <td className="py-2" colSpan={2}>
                                            None.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </Section>
                ))}

                <Section title="Tests">
                    <table className={TABLE}>
                        <thead>
                            <tr className="border-b">
                                <th className={TH}>Title</th>
                                <th className={TH}>Visibility</th>
                                <th className={TH}>Questions</th>
                                <th className={TH}>Published</th>
                            </tr>
                        </thead>
                        <tbody>
                            {detail.tests.map((t) => (
                                <tr key={t.id} className="border-b">
                                    <td className={TD}>{t.title}</td>
                                    <td className={TD}>{t.visibility}</td>
                                    <td className={TD}>{t.question_count}</td>
                                    <td className={TD}>{t.published_at ? formatWhen(t.published_at) : ''}</td>
                                </tr>
                            ))}
                            {detail.tests.length === 0 && (
                                <tr>
                                    <td className="py-2" colSpan={4}>
                                        No tests.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </Section>

                <Section title="Materials">
                    <table className={TABLE}>
                        <thead>
                            <tr className="border-b">
                                <th className={TH}>Title</th>
                                <th className={TH}>Visibility</th>
                                <th className={TH}>Size</th>
                                <th className={TH}>Published</th>
                            </tr>
                        </thead>
                        <tbody>
                            {detail.materials.map((m) => (
                                <tr key={m.id} className="border-b">
                                    <td className={TD}>{m.title}</td>
                                    <td className={TD}>{m.visibility}</td>
                                    <td className={TD}>{formatBytes(m.size_bytes)}</td>
                                    <td className={TD}>{m.published_at ? formatWhen(m.published_at) : ''}</td>
                                </tr>
                            ))}
                            {detail.materials.length === 0 && (
                                <tr>
                                    <td className="py-2" colSpan={4}>
                                        No materials.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </Section>

                <Section title="Generations">
                    <table className={TABLE}>
                        <thead>
                            <tr className="border-b">
                                <th className={TH}>#</th>
                                <th className={TH}>Title</th>
                                <th className={TH}>Status</th>
                                <th className={TH}>Cost</th>
                                <th className={TH}>Started</th>
                                <th className={TH}>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            {detail.generations.map((g) => (
                                <tr key={g.id} className="border-b">
                                    <td className={TD}>{g.id}</td>
                                    <td className={TD}>
                                        <Link href={`/admin/generations/${g.id}`} className="underline">
                                            {g.title}
                                        </Link>
                                    </td>
                                    <td className={TD}>{g.status}</td>
                                    <td className={TD}>{formatCents(g.list_cost_cents)}</td>
                                    <td className={TD}>{g.started_at ? formatWhen(g.started_at) : ''}</td>
                                    <td className={TD}>{formatDuration(g.duration_seconds)}</td>
                                </tr>
                            ))}
                            {detail.generations.length === 0 && (
                                <tr>
                                    <td className="py-2" colSpan={6}>
                                        No generations.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                    <Link href={`/admin/generations?user=${user.id}`} className="text-sm underline">
                        See all
                    </Link>
                </Section>

                <Section title="Notifications">
                    <table className={TABLE}>
                        <thead>
                            <tr className="border-b">
                                <th className={TH}>Type</th>
                                <th className={TH}>Message</th>
                                <th className={TH}>Sent</th>
                                <th className={TH}>Read</th>
                            </tr>
                        </thead>
                        <tbody>
                            {detail.notifications.map((n, i) => (
                                <tr key={i} className="border-b">
                                    <td className={TD}>{n.type}</td>
                                    <td className={TD}>{n.message ?? ''}</td>
                                    <td className={TD}>{formatWhen(n.created_at)}</td>
                                    <td className={TD}>{n.read_at ? formatWhen(n.read_at) : 'unread'}</td>
                                </tr>
                            ))}
                            {detail.notifications.length === 0 && (
                                <tr>
                                    <td className="py-2" colSpan={4}>
                                        None.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </Section>

                <Separator />
            </div>
        </AppLayout>
    );
}
