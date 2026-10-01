<?php

namespace App\Services;

use App\Models\Material;
use App\Models\User;
use App\Support\MaterialQuota;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * The ONE create path for a material file: the upload controller and the
 * course seeder both come through here, so a seeded guide lands on disk
 * exactly as an uploaded one does -- server-generated path under the
 * author's folder, content-sniffed mime type, measured size, the quota
 * checked under the author's row lock, and the file removed again if the
 * row never commits.
 */
final class MaterialWriter
{
    /**
     * @param  UploadedFile|string  $source  the upload, or the bytes themselves
     * @param  string  $originalName  the client's (or the seeder's) filename
     * @param  array<string, mixed>  $attrs  title, description, subject, grade_level, and optionally slug/visibility/published_at
     *
     * @throws ValidationException when the author's quota is reached
     */
    public static function create(User $author, UploadedFile|string $source, string $originalName, array $attrs): Material
    {
        $disk = Storage::disk(config('materials.disk'));
        $originalName = self::normalizeName($originalName);
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $folder = "materials/{$author->id}";
        $name = Str::random(40).($ext === '' ? '' : ".{$ext}");

        $path = $source instanceof UploadedFile
            ? $source->storeAs($folder, $name, config('materials.disk'))
            : ($disk->put("{$folder}/{$name}", $source) ? "{$folder}/{$name}" : false);
        // The disk is throw => false, so a failed write returns false rather
        // than throwing. Without this a row with an empty path would 201.
        abort_if($path === false, 500);

        $size = $source instanceof UploadedFile ? (int) $source->getSize() : strlen($source);

        try {
            return DB::transaction(function () use ($author, $attrs, $source, $path, $originalName, $size, $disk) {
                // The authoritative quota check. N parallel uploads at the
                // boundary all pass the request's friendly check; this one is
                // serialised behind a row lock on the author.
                User::whereKey($author->id)->lockForUpdate()->first();

                if ($error = MaterialQuota::errorFor($author, $size)) {
                    throw ValidationException::withMessages(['file' => [$error]]);
                }

                return $author->materials()->create([
                    'title' => filled($attrs['title'] ?? null) ? $attrs['title'] : self::titleFrom($originalName),
                    'description' => $attrs['description'] ?? null,
                    'subject' => $attrs['subject'],
                    'grade_level' => $attrs['grade_level'],
                    'visibility' => $attrs['visibility'] ?? 'private',
                    'published_at' => $attrs['published_at'] ?? null,
                    'slug' => $attrs['slug'] ?? null,
                    'original_name' => $originalName,
                    'path' => $path,
                    // Content-sniffed, never the client's claim. Both paths
                    // are finfo over the bytes: the upload's temp file or the
                    // stored file itself.
                    'mime_type' => $source instanceof UploadedFile ? $source->getMimeType() : self::sniff($path),
                    'size_bytes' => $size,
                ]);
            });
        } catch (Throwable $e) {
            // Anything after the write leaves an orphan file otherwise.
            $disk->delete($path);

            throw $e;
        }
    }

    /**
     * Overwrite the bytes at the SAME path -- the seeder re-running over a
     * guide it already placed. Quota is re-checked on the size delta.
     *
     * @throws ValidationException
     */
    public static function replace(Material $material, string $contents): Material
    {
        $disk = Storage::disk(config('materials.disk'));

        return DB::transaction(function () use ($material, $contents, $disk) {
            User::whereKey($material->user_id)->lockForUpdate()->first();

            $delta = strlen($contents) - $material->size_bytes;
            if ($delta > 0 && ($error = MaterialQuota::errorFor($material->author, $delta))) {
                throw ValidationException::withMessages(['file' => [$error]]);
            }

            abort_unless($disk->put($material->path, $contents), 500);

            $material->update([
                'mime_type' => self::sniff($material->path),
                'size_bytes' => strlen($contents),
            ]);

            return $material->fresh();
        });
    }

    /**
     * finfo over the stored bytes -- the same sniff UploadedFile::getMimeType
     * runs on an upload's temp file. NOT Storage::mimeType(): Flysystem
     * consults the extension first and reports .md as text/markdown, which
     * the allowlist does not carry and GetMaterial does not read.
     */
    private static function sniff(string $path): string
    {
        $absolute = Storage::disk(config('materials.disk'))->path($path);
        $type = (new \finfo(FILEINFO_MIME_TYPE))->file($absolute);

        return is_string($type) && $type !== '' ? $type : 'application/octet-stream';
    }

    /**
     * basename + control characters stripped + truncated to the column
     * BEFORE the insert: MySQL strict mode would otherwise 500 on a long
     * name with the file already on disk. Truncate from the stem, not the
     * right edge, so a long name keeps its extension.
     */
    public static function normalizeName(string $clientName): string
    {
        $name = basename($clientName);
        $name = preg_replace('/[\x00-\x1f\x7f]/', '', $name) ?? $name;
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $stem = pathinfo($name, PATHINFO_FILENAME);

        return $ext === ''
            ? Str::limit($stem, 255, '')
            : Str::limit($stem, 255 - strlen($ext) - 1, '').'.'.$ext;
    }

    /**
     * A stemless name like ".pdf" has no PATHINFO_FILENAME (''); fall back
     * to the full original name rather than an empty title.
     */
    private static function titleFrom(string $originalName): string
    {
        $stem = pathinfo($originalName, PATHINFO_FILENAME);

        return Str::limit(filled($stem) ? $stem : $originalName, 160, '');
    }
}
