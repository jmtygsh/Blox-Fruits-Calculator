<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key for the user
            $table->unsignedBigInteger('all_trade_id'); // Change this to match the type in `all-trade` table
            $table->text('comment'); // The comment text
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint for all_trade_id
            $table->foreign('all_trade_id')->references('batch_id')->on('all-trade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
