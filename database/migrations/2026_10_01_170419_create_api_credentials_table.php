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
        Schema::create('api_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Custom identifier, e.g., 'CricClubs Production API'
            $table->string('provider'); // Service provider name, e.g., 'cricclubs', 'youtube'
            $table->text('api_key')->nullable(); // Encrypted API key
            $table->text('api_secret')->nullable(); // Encrypted API secret / password
            $table->string('base_url')->nullable(); // Optional base URL for the API
            $table->json('additional_settings')->nullable(); // Any extra flexible config (JSON)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_credentials');
    }
};
