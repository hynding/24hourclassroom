<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Null = the server default (MATERIALS_MAX_FILES_PER_TEACHER, or
            // 100), so the existing row needs no data migration.
            $table->unsignedInteger('max_materials_per_teacher')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('max_materials_per_teacher');
        });
    }
};
