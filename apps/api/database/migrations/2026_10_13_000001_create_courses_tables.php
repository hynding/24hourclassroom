<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A course is an ordered list of its author's own tests and materials,
 * grouped under optional section headings. Publishing one is the author's
 * choice: a public course is readable logged out and its tests can be
 * practised with the answers available (CourseAccess).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // Seeder idempotency key; never set by the API or the editor.
            $table->string('slug', 120)->nullable()->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 160);
            $table->text('description')->nullable();
            $table->string('subject');
            $table->string('grade_level');
            $table->string('visibility')->default('private');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['visibility', 'subject', 'grade_level']);
            $table->index('user_id');
        });

        Schema::create('course_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->unsignedInteger('position');
            // A heading repeated verbatim on every item of its group, like a
            // question's stimulus; the views collapse identical neighbours.
            $table->string('section', 160)->nullable();
            // Exactly one of the two is set (CourseWriter). Deleting the test
            // or material removes it from every course that listed it.
            $table->foreignId('test_id')->nullable()->constrained('tests')->cascadeOnDelete();
            $table->foreignId('material_id')->nullable()->constrained('materials')->cascadeOnDelete();
            $table->timestamps();

            $table->index(['course_id', 'position']);
            // NULLs never collide in a unique index, so these hold each
            // test and each material to one appearance per course.
            $table->unique(['course_id', 'test_id']);
            $table->unique(['course_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_items');
        Schema::dropIfExists('courses');
    }
};
