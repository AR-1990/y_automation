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
        Schema::create('match_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cricket_match_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('event_type', [
                'SIX', 'FOUR', 'WICKET', 'MILESTONE_50', 'MILESTONE_100', 
                'BOWLING_MILESTONE_3W_4W_5W', 'PARTNERSHIP', 'INNINGS_BREAK', 'WINNING_RUNS'
            ]);
            $table->string('match_time')->nullable(); // e.g. "Over 8.4"
            $table->string('score_snapshot')->nullable(); // e.g. "73/3"
            $table->timestamp('event_timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_events');
    }
};