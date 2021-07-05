<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_text', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('post_id')->unique('post_id');
            $table->text('text');
            $table->foreign('post_id', 'fk_post_text_post_id')->references('id')->on('post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_text');
    }
}
