<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Defaults make the existing single row correct with no data migration.
            $table->string('name', 60)->default('24 Hour Classroom');
            $table->string('tagline', 160)->nullable()->default('A place for teachers to connect with other teachers and students — creating and sharing lesson plans, homework, study materials, practice tests, and reports.');
            $table->boolean('registration_open')->default(true);
            $table->string('registration_message', 300)->nullable();
            $table->boolean('banner_enabled')->default(false);
            $table->string('banner_text', 300)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['name', 'tagline', 'registration_open', 'registration_message', 'banner_enabled', 'banner_text']);
        });
    }
};
