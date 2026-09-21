<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 160);
            $table->text('description')->nullable();
            $table->string('subject');
            $table->string('grade_level');
            $table->string('visibility')->default('private');
            // The client's filename, basename'd and truncated before insert:
            // MySQL strict mode would otherwise 500 on a long name AFTER the
            // file is already on disk.
            $table->string('original_name', 255);
            // Server-generated, never client-derived.
            $table->string('path', 255)->unique();
            // Server-detected (a content sniff), never the client's claim.
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('size_bytes');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['visibility', 'subject', 'grade_level']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
