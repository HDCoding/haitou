<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('torrent_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('md5_peer_id', 45);
            $table->string('peer_id', 60);
            $table->string('ip', 70);
            $table->string('client', 70);
            $table->string('passkey', 45);
            $table->boolean('is_seeder')->default(0);
            $table->boolean('is_leecher')->default(0);
            $table->unsignedSmallInteger('port')->default(0);
            $table->unsignedBigInteger('uploaded')->default(0);
            $table->unsignedBigInteger('downloaded')->default(0);
            $table->unsignedBigInteger('remaining')->default(0);
            $table->timestamps();

            $table->foreign('torrent_id')->references('id')->on('torrents')
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
        Schema::dropIfExists('peers');
    }
}
