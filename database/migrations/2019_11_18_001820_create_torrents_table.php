<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torrents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('media_id')->index();
            $table->unsignedBigInteger('fansub_id')->index();
            $table->string('info_hash', 45);
            $table->string('name');
            $table->string('slug');
            $table->string('filename');
            $table->string('announce');
            $table->text('description');
            $table->bigInteger('size')->default(0);
            $table->integer('num_files')->default(0);
            $table->integer('views')->default(0);
            $table->integer('downs')->default(0);
            $table->integer('times_completed')->default(0);
            $table->integer('seeders')->default(0);
            $table->integer('leechers')->default(0);
            $table->boolean('allow_comments')->default(0);
            $table->boolean('is_anonymous')->default(0);
            $table->boolean('is_freeleech')->default(0);
            $table->boolean('is_silver')->default(0);
            $table->boolean('is_doubleup')->default(0);
            $table->boolean('vip_first')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('media_id')->references('id')->on('medias')->onUpdate('cascade');
            $table->foreign('fansub_id')->references('id')->on('fansubs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('torrents');
    }
}
