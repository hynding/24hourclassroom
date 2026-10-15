<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Discussion on tests, questions, materials and courses. One nullable
 * foreign key per kind of target rather than a polymorphic pair, so the
 * database deletes a discussion along with the thing it is about and no
 * comment can outlive its target (CommentTarget). Exactly one is set.
 *
 * One level of replies: `parent_id` always names a top-level comment on the
 * same target (CommentController flattens a reply to a reply).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->foreignId('test_id')->nullable()->constrained('tests')->cascadeOnDelete();
            $table->foreignId('question_id')->nullable()->constrained('questions')->cascadeOnDelete();
            $table->foreignId('material_id')->nullable()->constrained('materials')->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained('courses')->cascadeOnDelete();
            $table->text('body');
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
