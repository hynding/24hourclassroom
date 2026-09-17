<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 160);
            $table->text('description')->nullable();
            $table->string('subject');
            $table->string('grade_level');
            $table->string('visibility')->default('private');
            // A copy points at its source; deleting the source must not delete copies.
            $table->foreignId('copied_from_id')->nullable()->constrained('tests')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['visibility', 'subject', 'grade_level']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
