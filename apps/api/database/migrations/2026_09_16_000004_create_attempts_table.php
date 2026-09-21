<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            // Unassigning must not erase a student's history: the attempt
            // survives as self-practice-shaped (null assignment).
            $table->foreignId('assignment_id')->nullable()->constrained('assignments')->nullOnDelete();
            $table->timestamp('started_at');
            $table->timestamp('submitted_at')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->decimal('max_score', 8, 2)->nullable();
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();

            $table->index(['test_id', 'student_id']);
            $table->index('assignment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
