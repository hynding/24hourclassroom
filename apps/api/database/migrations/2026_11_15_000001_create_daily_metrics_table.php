<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Usage analytics, stored only as daily counters (App\Support\Metrics): no
 * visitor id, IP, user id or cookie is ever written, so there is nothing
 * to tie one count to a person.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->string('metric', 24);
            $table->string('dim', 191)->default('');
            $table->unsignedInteger('count')->default(0);
            $table->unique(['day', 'metric', 'dim']);
            $table->index(['metric', 'day']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_metrics');
    }
};
