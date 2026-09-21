<?php

namespace App\Services;

use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * The ONE delete path for a material (spec decision 9). Both the author's
 * controller and the admin's call it; a model event would not cover a mass
 * delete, and two copies of "row, then file" would drift.
 *
 * Row first, inside a transaction; file only after it commits, so a rolled
 * back delete never loses the bytes. The local disk is throw => false, so a
 * failed unlink returns false rather than throwing: that is logged and
 * swallowed, because the row is gone either way and an orphan file is an
 * operational concern, not the caller's.
 */
final class MaterialDeleter
{
    public static function delete(Material $material): void
    {
        $disk = config('materials.disk');
        $path = $material->path;

        DB::transaction(fn () => $material->delete());

        if (! Storage::disk($disk)->delete($path)) {
            Log::warning('Failed to delete a material file', ['disk' => $disk, 'path' => $path]);
        }
    }
}
