<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('actor_id')->index()->nullable();
            $table->unsignedBigInteger('calendar_id')->index()->nullable();
            $table->unsignedBigInteger('character_id')->index()->nullable();
            $table->unsignedBigInteger('fansub_id')->index()->nullable();
            $table->unsignedBigInteger('media_id')->index()->nullable();
            $table->unsignedBigInteger('studio_id')->index()->nullable();
            $table->unsignedBigInteger('torrent_id')->index()->nullable();
            $table->text('content');
            $table->boolean('is_spoiler')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('actor_id')->references('id')->on('actors')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('calendar_id')->references('id')->on('calendars')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('character_id')->references('id')->on('calendars')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('fansub_id')->references('id')->on('fansubs')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('media_id')->references('id')->on('medias')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('studio_id')->references('id')->on('studios')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('torrent_id')->references('id')->on('torrents')
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
        Schema::dropIfExists('comments');
    }
}
