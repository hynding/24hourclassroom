<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Curriculum standard codes (App\Support\Standards); null when untagged. */
    public function up(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->json('standards')->nullable()->after('grade_level');
        });
        Schema::table('materials', function (Blueprint $table) {
            $table->json('standards')->nullable()->after('grade_level');
        });
    }

    public function down(): void
    {
        Schema::table('tests', fn (Blueprint $table) => $table->dropColumn('standards'));
        Schema::table('materials', fn (Blueprint $table) => $table->dropColumn('standards'));
    }
};
