<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('post_id');
            $table->integer('customer_id');
            $table->string('text', 100);
            $table->integer('likes')->default(0);
            $table->foreign('customer_id', 'fk_post_comment_customer_id')->references('id')->on('customer');
            $table->foreign('post_id', 'fk_post_comment_post_id')->references('id')->on('post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comment');
    }
}
