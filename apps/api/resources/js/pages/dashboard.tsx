import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

type Metrics = {
    users_by_role: {
        teacher: number;
        student: number;
        admin: number;
    };
    verified_percentage: number;
    follows: number;
    connections: number;
};

export default function Dashboard({ metrics }: { metrics: Metrics | null }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
                        {metrics ? (
                            <div className="flex size-full flex-col justify-center gap-2 p-4 text-sm">
                                <h2 className="font-medium">Platform metrics</h2>
                                <ul className="text-muted-foreground space-y-1">
                                    <li>Teachers: {metrics.users_by_role.teacher}</li>
                                    <li>Students: {metrics.users_by_role.student}</li>
                                    <li>Admins: {metrics.users_by_role.admin}</li>
                                    <li>Verified: {metrics.verified_percentage}%</li>
                                    <li>Follows: {metrics.follows}</li>
                                    <li>Connections: {metrics.connections}</li>
                                </ul>
                            </div>
                        ) : (
                            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                        )}
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
            </div>
        </AppLayout>
    );
}
