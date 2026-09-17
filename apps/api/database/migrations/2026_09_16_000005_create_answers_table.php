<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('attempts')->cascadeOnDelete();
            // Cascades only on a HARD delete of the question (via the test).
            // A soft-deleted question keeps its answer rows.
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->json('response')->nullable();
            $table->decimal('awarded', 8, 2)->nullable();
            // Snapshot of {answer, points} at grading time -- decision 7.
            $table->json('graded_answer')->nullable();
            $table->foreignId('graded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['attempt_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
