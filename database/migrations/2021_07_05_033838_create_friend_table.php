<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('customer_id');
            $table->integer('friendship_id');
            $table->foreign('customer_id', 'fk_friend_customer_id')->references('id')->on('customer');
            $table->foreign('friendship_id', 'fk_friend_friendship_id')->references('id')->on('friendship');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend');
    }
}
