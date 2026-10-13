<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The side panel (layout `rail`) becomes the default, and the site switches
 * to it: the top header ran off the edge of a phone once a teacher's links
 * outgrew it. Admins can still choose the top header (`stacked`) at
 * /admin/site-theme; this flips the stored value once, it does not remove
 * the choice.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('layout')->default('rail')->change();
        });

        DB::table('site_settings')->where('layout', 'stacked')->update(['layout' => 'rail', 'updated_at' => now()]);
    }

    public function down(): void
    {
        // The column default only. Which layout a site was on before this
        // ran is not recorded, so the stored value is left as it is.
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('layout')->default('stacked')->change();
        });
    }
};
