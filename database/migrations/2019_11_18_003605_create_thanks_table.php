<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thanks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('calendar_id')->index()->nullable();
            $table->unsignedBigInteger('torrent_id')->index()->nullable();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('calendar_id')->references('id')->on('calendars')
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
        Schema::dropIfExists('thanks');
    }
}
