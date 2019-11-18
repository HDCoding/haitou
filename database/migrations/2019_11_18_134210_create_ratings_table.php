<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('media_id')->index()->nullable();
            $table->unsignedBigInteger('torrent_id')->index()->nullable();
            $table->unsignedTinyInteger('vote'); //1 to 10

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('media_id')->references('id')->on('medias')
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
        Schema::dropIfExists('ratings');
    }
}
