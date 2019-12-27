<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorrentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torrent_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('torrent_id')->index();
            $table->unsignedBigInteger('tag_id')->index();
            $table->primary(['torrent_id','tag_id']);

            $table->foreign('torrent_id')->references('id')->on('torrents')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('torrent_tags');
    }
}
