<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_participant', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('customer_id');
            $table->integer('group_id');
            $table->foreign('customer_id', 'fk_group_participant_customer_id')->references('id')->on('customer');
            $table->foreign('group_id', 'fk_group_partipant_group_id')->references('id')->on('group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_participant');
    }
}
