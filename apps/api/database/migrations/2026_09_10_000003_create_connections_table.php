<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('addressee_id')->constrained('users')->cascadeOnDelete();
            $table->string('status')->default('pending');
            // min-max of the two ids. A unique index on (requester, addressee)
            // would still admit A->B and B->A concurrently; this makes the pair
            // itself unique regardless of who asked.
            $table->string('pair_key');
            $table->timestamps();

            $table->unique('pair_key');
            $table->index('addressee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
