<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaCastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_casts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('media_id')->index();
            $table->unsignedBigInteger('character_id')->index()->nullable();
            $table->unsignedBigInteger('actor_id')->index()->nullable();

            $table->foreign('media_id')->references('id')->on('medias')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('character_id')->references('id')->on('characters')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('actor_id')->references('id')->on('actors')
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
        Schema::dropIfExists('media_casts');
    }
}
