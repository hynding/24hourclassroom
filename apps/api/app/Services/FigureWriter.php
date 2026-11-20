<?php

namespace App\Services;

use App\Models\Figure;
use App\Models\User;
use App\Support\SafeSvg;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

/**
 * The one path that puts a question picture on disk: teacher uploads
 * (PNG/JPEG, sniffed) and the course seeder (SVG, PNG or JPEG bytes from
 * the data directory). Server-generated path, measured size, the
 * per-teacher cap checked under the owner's row lock.
 */
final class FigureWriter
{
    private const EXTENSIONS = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/svg+xml' => 'svg'];

    public static function upload(User $owner, UploadedFile $file): Figure
    {
        $mime = (string) $file->getMimeType();
        if (! in_array($mime, config('figures.upload_mimetypes'), true)) {
            throw ValidationException::withMessages(['file' => ['Choose a PNG or JPEG picture.']]);
        }

        return self::store($owner, (string) file_get_contents($file->getRealPath()), $mime, null);
    }

    /**
     * Seeder path: create the figure for `$slug`, or replace its bytes in
     * place on a re-run (and move it to `$owner` if the course moved).
     */
    public static function seed(User $owner, string $slug, string $bytes, string $mime): Figure
    {
        if ($mime === 'image/svg+xml' && ($why = SafeSvg::problem($bytes)) !== null) {
            throw new InvalidArgumentException("figure {$slug} {$why}");
        }
        $existing = Figure::where('slug', $slug)->first();
        if ($existing === null) {
            return self::store($owner, $bytes, $mime, $slug);
        }

        $disk = Storage::disk(config('figures.disk'));
        $path = self::path($owner, $mime);
        abort_if(! $disk->put($path, $bytes), 500);
        $old = $existing->path;
        $existing->update(['user_id' => $owner->id, 'path' => $path, 'mime_type' => $mime, 'size_bytes' => strlen($bytes)]);
        if ($old !== $path) {
            $disk->delete($old);
        }

        return $existing;
    }

    private static function store(User $owner, string $bytes, string $mime, ?string $slug): Figure
    {
        $disk = Storage::disk(config('figures.disk'));
        $path = self::path($owner, $mime);
        abort_if(! $disk->put($path, $bytes), 500);

        try {
            return DB::transaction(function () use ($owner, $bytes, $mime, $slug, $path) {
                User::whereKey($owner->id)->lockForUpdate()->first();
                $max = (int) config('figures.max_per_teacher');
                if ($slug === null && Figure::where('user_id', $owner->id)->count() >= $max) {
                    throw ValidationException::withMessages(['file' => ["You have reached the limit of {$max} pictures."]]);
                }

                return Figure::create([
                    'user_id' => $owner->id, 'slug' => $slug, 'path' => $path,
                    'mime_type' => $mime, 'size_bytes' => strlen($bytes),
                ]);
            });
        } catch (\Throwable $e) {
            $disk->delete($path);
            throw $e;
        }
    }

    private static function path(User $owner, string $mime): string
    {
        $ext = self::EXTENSIONS[$mime] ?? throw new InvalidArgumentException("unsupported figure type {$mime}");

        return "figures/{$owner->id}/".Str::random(40).".{$ext}";
    }
}
