<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->unsignedInteger('position');
            $table->string('type');
            $table->text('prompt');
            $table->json('options')->nullable();
            // Scalar or structure depending on `type`; MySQL JSON accepts both.
            $table->json('answer');
            $table->unsignedInteger('points')->default(1);
            $table->boolean('partial_credit')->default(false);
            $table->text('explanation')->nullable();
            // Soft delete: an attempt graded against this question must keep
            // rendering it after the author removes it from the test.
            $table->softDeletes();
            $table->timestamps();

            $table->index(['test_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
