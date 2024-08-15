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
            $table->string('ip_address'); // to store the user's public IP address
            $table->string('state')->nullable(); // to store the user's state
            $table->string('country')->nullable(); // to store the user's country
            $table->string('user_agent'); // to store the user's browser or device information
            $table->timestamps();
        
            // Ensure a user can only like once based on IP address, user agent, state, and country
            $table->unique(['ip_address', 'user_agent', 'state', 'country']);
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
