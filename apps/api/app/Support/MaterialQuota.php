<?php

namespace App\Support;

use App\Models\Material;
use App\Models\User;

/**
 * The per-teacher caps (spec decision 8: the host is shared, a verified
 * account must not be able to fill its disk). One definition, called twice --
 * once for the friendly 422 during validation, once again inside the store
 * transaction under a row lock, because N parallel uploads at the boundary
 * would all pass the first check.
 */
final class MaterialQuota
{
    /** The message to show, or null when this upload fits. */
    public static function errorFor(User $author, int $incomingBytes): ?string
    {
        // Count and total in ONE query. Deleted materials free quota
        // immediately -- there is no soft delete on materials.
        $usage = Material::query()
            ->where('user_id', $author->id)
            ->selectRaw('COUNT(*) as files, COALESCE(SUM(size_bytes), 0) as bytes')
            ->first();

        $maxFiles = (int) config('materials.max_files_per_teacher');
        $maxBytes = (int) config('materials.max_bytes_per_teacher');

        if ((int) $usage->files + 1 > $maxFiles) {
            return "You have reached the limit of {$maxFiles} materials.";
        }

        if ((int) $usage->bytes + $incomingBytes > $maxBytes) {
            $mb = intdiv($maxBytes, 1048576);

            return "This file would take your materials over {$mb} MB.";
        }

        return null;
    }
}
