<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('studio_id')->index();
            $table->string('name');
            $table->string('slug');
            $table->string('title_english')->nullable();
            $table->string('title_japanese')->nullable();
            $table->tinyInteger('media_type'); //0 = anime, 1 = manga, 2 = dorama, 3 = movie
            $table->date('released_at');
            $table->date('finished_at')->nullable();
            $table->text('description');
            $table->boolean('is_adult')->default(0);
            $table->string('cover')->nullable();
            $table->string('poster')->nullable();
            $table->tinyInteger('status'); // 0 = Finalizado, 1 = Exibindo, 2 = Cancelado
            $table->string('yt_video', 45)->nullable();
            $table->integer('views')->default(0);
            $table->unsignedSmallInteger('total_episodes')->nullable();
            $table->unsignedSmallInteger('duration')->nullable();
            $table->unsignedSmallInteger('total_chapters')->nullable();
            $table->unsignedSmallInteger('total_volumes')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('studio_id')->references('id')->on('studios')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
