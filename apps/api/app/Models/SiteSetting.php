<?php

namespace App\Models;

use App\Enums\Layout;
use App\Enums\Palette;
use App\Enums\Typeset;
use App\Support\Registration;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const DEFAULT_TAGLINE = 'A place for teachers to connect with other teachers and students — creating and sharing lesson plans, homework, study materials, practice tests, and reports.';

    protected $fillable = [
        'layout', 'palette', 'typeset',
        'name', 'tagline', 'registration_open', 'registration_message', 'banner_enabled', 'banner_text',
        'max_materials_per_teacher',
    ];

    protected function casts(): array
    {
        return [
            'layout' => Layout::class,
            'palette' => Palette::class,
            'typeset' => Typeset::class,
            'registration_open' => 'boolean',
            'banner_enabled' => 'boolean',
            'max_materials_per_teacher' => 'integer',
        ];
    }

    /**
     * The one settings row. `firstOrCreate(['id' => 1])` would NOT work: `id`
     * is not fillable, so a missing row would be created with the next
     * auto-increment id instead of 1. forceCreate pins it. The six site
     * columns are listed even though the schema defaults them: forceCreate
     * does not refresh the model, so without them the returned instance
     * would read null for every one of them.
     */
    public static function current(): self
    {
        return static::query()->find(1) ?? static::query()->forceCreate([
            'id' => 1,
            'layout' => Layout::Rail,
            'palette' => Palette::Noon,
            'typeset' => Typeset::Editorial,
            'name' => '24 Hour Classroom',
            'tagline' => self::DEFAULT_TAGLINE,
            'registration_open' => true,
            'registration_message' => null,
            'banner_enabled' => false,
            'banner_text' => null,
            'max_materials_per_teacher' => null,
        ]);
    }

    /** @return array{layout: string, palette: string, typeset: string} */
    public function theme(): array
    {
        return [
            'layout' => $this->layout->value,
            'palette' => $this->palette->value,
            'typeset' => $this->typeset->value,
        ];
    }

    /**
     * The whole public shape GET /api/site serves. Drafts are suppressed: the
     * closed message only while closed, the banner text only while enabled.
     * The default sentence is inlined via the constant rather than
     * Registration::closedMessage(), which would re-read this row.
     *
     * @return array<string, mixed>
     */
    public function config(): array
    {
        return [
            'theme' => $this->theme(),
            'identity' => ['name' => $this->name, 'tagline' => $this->tagline],
            'registration' => [
                'open' => $this->registration_open,
                'message' => $this->registration_open ? null : ($this->registration_message ?: Registration::CLOSED),
            ],
            'banner' => [
                'enabled' => $this->banner_enabled,
                'text' => $this->banner_enabled ? $this->banner_text : null,
            ],
        ];
    }
}
