<?php

namespace App\Support;

use App\Models\Profile;

final class ProfilePayload
{
    /**
     * The one profile JSON shape in the app. Deliberately not a JsonResource:
     * a single JsonResource wraps itself in a `data` envelope, which would make
     * GET /api/profile inconsistent with the bare object GET /api/user returns.
     *
     * @return array<string, mixed>
     */
    public static function for(?Profile $profile): array
    {
        return [
            'bio' => $profile?->bio,
            'school' => $profile?->school,
            'specialties' => $profile?->specialties,
            'subjects' => $profile?->subjects ?? [],
            'grade_levels' => $profile?->grade_levels ?? [],
            'avatar_url' => $profile?->avatar_url,
        ];
    }
}
