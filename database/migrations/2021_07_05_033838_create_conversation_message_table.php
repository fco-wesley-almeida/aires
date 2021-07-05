<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_message', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('customer_id');
            $table->integer('conversation_id');
            $table->string('message', 100);
            $table->foreign('conversation_id', 'fk_conversation_message_conversation_id')->references('id')->on('conversation');
            $table->foreign('customer_id', 'fk_conversation_message_customer_id')->references('id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversation_message');
    }
}
