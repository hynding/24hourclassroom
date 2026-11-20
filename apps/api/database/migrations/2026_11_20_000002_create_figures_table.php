<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A picture a question shows (number line, array, clock, bar graph).
     * Owned by the teacher who uploaded or seeded it; a question points at
     * one and carries its own alt text. `slug` is the seeder's idempotency
     * key, like the other content tables.
     */
    public function up(): void
    {
        Schema::create('figures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('slug', 160)->nullable()->unique();
            $table->string('path', 255)->unique();
            $table->string('mime_type', 100);
            $table->unsignedInteger('size_bytes');
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId('figure_id')->nullable()->after('stimulus')->constrained('figures')->nullOnDelete();
            $table->string('figure_alt', 500)->nullable()->after('figure_id');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('figure_id');
            $table->dropColumn('figure_alt');
        });
        Schema::dropIfExists('figures');
    }
};
