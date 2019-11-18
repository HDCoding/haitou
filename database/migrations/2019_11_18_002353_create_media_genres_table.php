<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('media_id')->index();
            $table->unsignedBigInteger('genre_id')->index();

            $table->foreign('media_id')->references('id')->on('medias')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('genre_id')->references('id')->on('genres')
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
        Schema::dropIfExists('media_genres');
    }
}
