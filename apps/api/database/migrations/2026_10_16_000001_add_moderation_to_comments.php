<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Moderation for a public course's discussion (CommentAccess).
 *
 * `status` defaults to approved, so every comment written before moderation
 * existed stays on show. `deleted_at` keeps a deleted comment for
 * administrators only; deleting the target still removes its whole
 * discussion through the foreign keys.
 *
 * `courses.comment_reactions` switches thumbs up and down on a course's
 * approved comments. Off for every course, existing and new, until its
 * author turns it on.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('status', 16)->default('approved')->after('body');
            $table->softDeletes();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('comment_reactions')->default(false)->after('visibility');
        });

        Schema::create('comment_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('value', 8);
            $table->timestamps();

            $table->unique(['comment_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comment_reactions');

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('comment_reactions');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('status');
        });
    }
};
