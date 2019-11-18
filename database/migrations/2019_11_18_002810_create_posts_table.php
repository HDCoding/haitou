<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forum_id')->index();
            $table->unsignedBigInteger('topic_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('post_username', 25);
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('forum_id')->references('id')->on('forums')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('topic_id')->references('id')->on('topics')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
