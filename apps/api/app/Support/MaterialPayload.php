<?php

namespace App\Support;

use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\URL;

/**
 * The two material body shapes, in one place -- TestPayload's role for tests.
 * `view()` is what EVERY single-material response returns (show, create,
 * update, publish, unpublish), flat and with no `data` envelope, so the SPA's
 * spread-merge after an action can never drop the download link.
 */
final class MaterialPayload
{
    /** The MaterialSummary row shape. @return array<string, mixed> */
    public static function summary(Material $material): array
    {
        $material->loadMissing('author');

        return [
            'id' => $material->id,
            'title' => $material->title,
            'subject' => $material->subject,
            'grade_level' => $material->grade_level,
            'visibility' => $material->visibility,
            'published_at' => $material->published_at,
            'original_name' => $material->original_name,
            'mime_type' => $material->mime_type,
            'size_bytes' => $material->size_bytes,
            'author' => ['id' => $material->author->id, 'name' => $material->author->name],
        ];
    }

    /** The MaterialView shape. @return array<string, mixed> */
    public static function view(Material $material, ?User $viewer): array
    {
        return self::summary($material) + [
            'description' => $material->description,
            'created_at' => $material->created_at,
            'updated_at' => $material->updated_at,
            'is_author' => MaterialAccess::canAuthor($viewer, $material),
            'shared_with_me' => MaterialAccess::hasLiveShare($viewer, $material),
            'download_url' => self::downloadUrl($material, $viewer),
        ];
    }

    /**
     * A bearer capability for at most 15 minutes, bound to the viewer's
     * PERMISSIONS (re-evaluated on use) rather than to their session.
     *
     * `absolute: false` + `signed:relative` on the route: relative
     * verification compares '/'.$request->path(), so a scheme or host
     * difference between APP_URL and what the shared host's proxy presents to
     * PHP (no trustProxies is configured) cannot 403 every production
     * download. The rtrim is because an APP_URL with a trailing slash would
     * produce '//api/...', which the router does not match at all.
     */
    public static function downloadUrl(Material $material, ?User $viewer): string
    {
        return rtrim((string) config('app.url'), '/').URL::temporarySignedRoute(
            'materials.file',
            now()->addMinutes(15),
            ['material' => $material->id, 'viewer' => $viewer?->id ?? 0],
            absolute: false,
        );
    }
}
