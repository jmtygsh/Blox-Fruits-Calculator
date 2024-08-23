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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45); // IPv4 or IPv6 address
            $table->string('state', 50)->nullable(); // Limit the length of state
            $table->string('country', 50)->nullable(); // Limit the length of country
            $table->string('user_agent', 255); // Limit the length of user agent
            $table->timestamps();

            // Use a prefix length for each column in the unique index
            $table->unique(['ip_address', 'user_agent', 'state', 'country'], 'likes_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
