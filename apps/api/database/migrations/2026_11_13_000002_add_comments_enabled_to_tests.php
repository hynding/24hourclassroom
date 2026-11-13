<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The author's switch for a test's discussion and its questions' threads
     * (CommentAccess::isClosed). On by default: every existing test keeps
     * the discussion it has.
     */
    public function up(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->boolean('comments_enabled')->default(true)->after('visibility');
        });
    }

    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('comments_enabled');
        });
    }
};
