<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A flashcard deck's cards the learner marked as known (StudyProgress):
     * short keys the SPA derives from each card's front, never the text.
     */
    public function up(): void
    {
        Schema::table('study_progress', function (Blueprint $table) {
            $table->json('known_cards')->nullable()->after('runs');
        });
    }

    public function down(): void
    {
        Schema::table('study_progress', function (Blueprint $table) {
            $table->dropColumn('known_cards');
        });
    }
};
