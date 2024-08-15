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
        Schema::create('all-trade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id'); // Correct column type
            $table->string('image');
            $table->unsignedBigInteger('user_id'); // Correct column type
            $table->unsignedBigInteger('card_id');
            $table->string('name', 60);
            $table->string('value', 60);
            $table->string('p_value', 60);
            $table->string('price', 60);
            $table->boolean('isPermanent')->default(false);
            $table->string('isSide', 5);
            $table->timestamps();

            // Optionally, you may want to add an index for batch_id if it’s used frequently in queries
            $table->index('batch_id');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all-trade');
    }
};
