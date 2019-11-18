<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('character_id')->index()->nullable();
            $table->unsignedBigInteger('actor_id')->index()->nullable();
            $table->unsignedBigInteger('media_id')->index()->nullable();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('character_id')->references('id')->on('characters')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('actor_id')->references('id')->on('actors')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('media_id')->references('id')->on('medias')
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
        Schema::dropIfExists('bookmarks');
    }
}
