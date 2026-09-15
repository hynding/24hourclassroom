<?php

namespace App\Models;

use App\Enums\Layout;
use App\Enums\Palette;
use App\Enums\Typeset;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['layout', 'palette', 'typeset'];

    protected function casts(): array
    {
        return [
            'layout' => Layout::class,
            'palette' => Palette::class,
            'typeset' => Typeset::class,
        ];
    }

    /**
     * The one settings row. `firstOrCreate(['id' => 1])` would NOT work: `id`
     * is not fillable, so a missing row would be created with the next
     * auto-increment id instead of 1. forceCreate pins it.
     */
    public static function current(): self
    {
        return static::query()->find(1) ?? static::query()->forceCreate([
            'id' => 1,
            'layout' => Layout::Stacked,
            'palette' => Palette::Noon,
            'typeset' => Typeset::Editorial,
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
}
