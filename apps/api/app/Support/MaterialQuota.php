<?php

namespace App\Support;

use App\Models\Material;
use App\Models\SiteSetting;
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
    /**
     * The per-teacher file cap in force: the admin's setting on the Site
     * settings page, or the server default (MATERIALS_MAX_FILES_PER_TEACHER,
     * else 100) while that is blank. Reads row 1 with find(1), never
     * current(), so checking a quota can never create the settings row.
     */
    public static function maxFiles(): int
    {
        return SiteSetting::query()->find(1)?->max_materials_per_teacher
            ?? (int) config('materials.max_files_per_teacher');
    }

    /**
     * The message to show, or null when this write fits. `$incomingFiles` is
     * 1 for an upload and 0 when an existing file's bytes are replaced in
     * place, which grows the byte total but not the file count.
     */
    public static function errorFor(User $author, int $incomingBytes, int $incomingFiles = 1): ?string
    {
        // Count and total in ONE query. Deleted materials free quota
        // immediately -- there is no soft delete on materials.
        $usage = Material::query()
            ->where('user_id', $author->id)
            ->selectRaw('COUNT(*) as files, COALESCE(SUM(size_bytes), 0) as bytes')
            ->first();

        $maxFiles = self::maxFiles();
        $maxBytes = (int) config('materials.max_bytes_per_teacher');

        if ($incomingFiles > 0 && (int) $usage->files + $incomingFiles > $maxFiles) {
            return "You have reached the limit of {$maxFiles} materials.";
        }

        if ((int) $usage->bytes + $incomingBytes > $maxBytes) {
            $mb = intdiv($maxBytes, 1048576);

            return "This file would take your materials over {$mb} MB.";
        }

        return null;
    }
}
