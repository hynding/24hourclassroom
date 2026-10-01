import { ConfirmButton } from '@/components/confirm-button';

type Props = { id: number; title: string; live: boolean; hasLeftovers: boolean };

/**
 * Cancel for a live run, Retry teardown for a finished one with leftovers.
 * Both flags come from the server; nothing here derives them from `status`.
 */
export function GenerationActions({ id, title, live, hasLeftovers }: Props) {
    if (!live && !hasLeftovers) {
        return null;
    }

    return (
        <div className="flex gap-2">
            {live && (
                <ConfirmButton
                    label="Cancel"
                    variant="destructive"
                    size="sm"
                    method="post"
                    url={`/admin/generations/${id}/cancel`}
                    confirm={`Cancel generation #${id} "${title}"? The teacher will be notified.`}
                />
            )}
            {hasLeftovers && (
                <ConfirmButton
                    label="Retry teardown"
                    variant="outline"
                    size="sm"
                    method="post"
                    url={`/admin/generations/${id}/teardown`}
                    confirm={`Retry the cleanup for generation #${id}? This talks to Anthropic under the teacher's key and spends one teardown attempt.`}
                />
            )}
        </div>
    );
}
