import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/react';

type Props = { id: number; title: string; live: boolean; hasLeftovers: boolean };

/**
 * Cancel for a live run, Retry teardown for a finished one with leftovers.
 * Both flags come from the server; nothing here derives them from `status`.
 */
export function GenerationActions({ id, title, live, hasLeftovers }: Props) {
    const cancel = () => {
        if (confirm(`Cancel generation #${id} "${title}"? The teacher will be notified.`)) {
            router.post(`/admin/generations/${id}/cancel`, {}, { preserveScroll: true });
        }
    };

    const retryTeardown = () => {
        if (confirm(`Retry the cleanup for generation #${id}? This talks to Anthropic under the teacher's key and spends one teardown attempt.`)) {
            router.post(`/admin/generations/${id}/teardown`, {}, { preserveScroll: true });
        }
    };

    if (!live && !hasLeftovers) {
        return null;
    }

    return (
        <div className="flex gap-2">
            {live && (
                <Button type="button" variant="destructive" size="sm" onClick={cancel}>
                    Cancel
                </Button>
            )}
            {hasLeftovers && (
                <Button type="button" variant="outline" size="sm" onClick={retryTeardown}>
                    Retry teardown
                </Button>
            )}
        </div>
    );
}
