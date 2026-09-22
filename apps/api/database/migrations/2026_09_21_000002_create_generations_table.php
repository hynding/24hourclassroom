<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 160);
            $table->string('subject');
            $table->string('grade_level');
            $table->text('instructions')->nullable();
            $table->unsignedTinyInteger('question_count');
            $table->json('material_ids');
            // The Anthropic file ids uploaded for this run; deleted and nulled
            // by SessionTeardown, so a non-null value means bytes still exist
            // in the teacher's organisation.
            $table->json('file_ids')->nullable();
            $table->string('status')->default('queued');
            $table->string('session_id')->nullable();
            // "Processed up to here", ours -- not a server cursor.
            $table->string('last_event_id')->nullable();
            $table->string('pending_tool_event_id')->nullable();
            $table->json('pending_tool_result')->nullable();
            $table->unsignedTinyInteger('tool_failures')->default(0);
            $table->text('agent_note')->nullable();
            $table->text('error')->nullable();
            $table->unsignedInteger('list_cost_cents')->nullable();
            // nullOnDelete: deleting the draft must not delete its history.
            $table->foreignId('test_id')->nullable()->constrained('tests')->nullOnDelete();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('generations');
    }
};
