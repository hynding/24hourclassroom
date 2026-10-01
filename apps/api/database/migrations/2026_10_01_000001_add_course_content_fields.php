<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            // A passage, figure description or data table shared by a set of
            // consecutive questions. Repeated verbatim on every member; the
            // views collapse identical neighbours into one block.
            $table->text('stimulus')->nullable()->after('prompt');
            // Parallel to `options`: why each choice is right or wrong.
            $table->json('option_explanations')->nullable()->after('options');
            // fill_blank only: false means the item is graded by hand.
            $table->boolean('auto_grade')->default(true)->after('partial_credit');
            // Seeder idempotency key; never set by the API or the editor.
            $table->string('slug', 80)->nullable()->after('id');

            $table->unique(['test_id', 'slug']);
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->string('slug', 120)->nullable()->unique()->after('id');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->string('slug', 120)->nullable()->unique()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropUnique(['test_id', 'slug']);
            $table->dropColumn(['stimulus', 'option_explanations', 'auto_grade', 'slug']);
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
