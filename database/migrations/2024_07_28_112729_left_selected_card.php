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
        Schema::create('left_selected_cards', function (Blueprint $table) {
            $table->id();
            $table->string('image'); 
            $table->string('user_id'); // Change this to string
            $table->string('card_id');
            $table->string('name', 60);
            $table->string('value', 60);
            $table->string('p_value', 60);
            $table->string('price', 60);
            $table->boolean('isPermanent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('left__selected_cards');
    }
};
