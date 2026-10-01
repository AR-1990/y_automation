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
        Schema::create('media_clips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_event_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->text('caption')->nullable();
            $table->string('hashtags')->nullable();
            $table->integer('priority_score')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected', 'published'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_clips');
    }
};