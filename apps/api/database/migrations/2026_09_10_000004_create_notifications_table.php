<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Stock Laravel notifications sort newest-first by `created_at`
            // alone, which MySQL stores at whole-second precision regardless
            // of the column's declared precision (its grammar always
            // serialises dates as 'Y-m-d H:i:s'). `id` is a random UUID, not
            // time-ordered, so it cannot break ties either. Two notifications
            // created within the same second -- routine, not an edge case --
            // would otherwise come back in an arbitrary order instead of
            // deterministically newest-first. `sequence` is a monotonic
            // auto-increment surrogate that exists purely to make that order
            // reliable; MySQL requires an auto-increment column to lead a
            // key, so it is the first column of the composite primary key
            // (`id` keeps its own unique index and remains the column the
            // app and DatabaseNotification address rows by).
            $table->unsignedBigInteger('sequence')->autoIncrement();
            $table->primary(['sequence', 'id']);
            $table->unique('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
