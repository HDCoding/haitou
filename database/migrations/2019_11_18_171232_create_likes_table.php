<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('torrent_id')->index()->nullable();
            $table->unsignedBigInteger('post_id')->index()->nullable();
            $table->boolean('is_like')->default(0);
            $table->boolean('is_dislike')->default(0);

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('torrent_id')->references('id')->on('torrents')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('post_id')->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
