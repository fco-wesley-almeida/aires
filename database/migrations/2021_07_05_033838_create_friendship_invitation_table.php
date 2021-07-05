<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendshipInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendship_invitation', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('requester_customer_id');
            $table->integer('target_customer_id');
            $table->integer('accepted')->default(-1);
            $table->foreign('requester_customer_id', 'fk_friendship_request_customer_id')->references('id')->on('customer');
            $table->foreign('target_customer_id', 'fk_friendship_target_customer_id')->references('id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendship_invitation');
    }
}
