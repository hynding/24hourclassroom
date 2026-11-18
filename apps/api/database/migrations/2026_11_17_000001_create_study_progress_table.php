<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A learner's own progress through course content (App\Support\StudyProgress):
     * one row per person per test (their practice runs) or per material
     * (marked done). Exactly one of test_id / material_id is set. Keyed on
     * the item, not the course, so a test or reading done once shows as done
     * in every course that holds it. Everything cascades: deleting the
     * person or the item deletes the row.
     */
    public function up(): void
    {
        Schema::create('study_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('material_id')->nullable()->constrained()->cascadeOnDelete();
            // Practice runs: the best (by fraction of the marked points) and
            // the latest, each with the points marked at the time.
            $table->decimal('best_score', 8, 2)->nullable();
            $table->unsignedInteger('best_max')->nullable();
            $table->decimal('last_score', 8, 2)->nullable();
            $table->unsignedInteger('last_max')->nullable();
            $table->unsignedInteger('runs')->default(0);
            // A finished practice run, or a material marked done.
            $table->timestamp('done_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'test_id']);
            $table->unique(['user_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_progress');
    }
};
