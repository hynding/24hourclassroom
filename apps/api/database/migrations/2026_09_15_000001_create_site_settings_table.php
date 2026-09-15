<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('layout')->default('stacked');
            $table->string('palette')->default('noon');
            $table->string('typeset')->default('editorial');
            $table->timestamps();
        });

        // Single-row table: the row exists from the first deploy so no code
        // path ever has to handle "no settings yet".
        DB::table('site_settings')->insert([
            'id' => 1,
            'layout' => 'stacked',
            'palette' => 'noon',
            'typeset' => 'editorial',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
