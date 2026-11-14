<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('url_slugs', function (Blueprint $table) {
            $table->id();
            $table->string('kind', 20);
            // 0 for the site-wide kinds; the teacher's id for teacher_course.
            $table->unsignedBigInteger('scope_id')->default(0);
            $table->string('slug', 60);
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('status', 20);
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            // Every row, retired and rejected included: a slug is never reissued.
            $table->unique(['kind', 'scope_id', 'slug']);
            $table->index(['kind', 'status']);
        });

        // /courses/precalculus for the seeded Precalculus course, wherever it
        // has been seeded (the owner asked for it with this feature).
        $course = DB::table('courses')->where('slug', 'precalc')->value('id');
        if ($course !== null) {
            DB::table('url_slugs')->insert([
                'kind' => 'site_course',
                'scope_id' => 0,
                'slug' => 'precalculus',
                'course_id' => $course,
                'status' => 'approved',
                'reviewed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('url_slugs');
    }
};
