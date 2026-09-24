<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            // unique(): exactly one integration row per user. Two concurrent
            // creates are what Integration::forUser()'s createOrFirst rescues.
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            // Laravel's `encrypted` cast: ciphertext, never the key itself.
            $table->text('anthropic_api_key')->nullable();
            $table->string('anthropic_key_hint', 4)->nullable();
            $table->timestamp('anthropic_key_verified_at')->nullable();
            $table->string('anthropic_environment_id')->nullable();
            $table->string('anthropic_agent_id')->nullable();
            $table->unsignedInteger('anthropic_agent_version')->nullable();
            $table->string('anthropic_config_hash', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integrations');
    }
};
