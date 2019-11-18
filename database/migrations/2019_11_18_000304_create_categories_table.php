<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('color', 10)->nullable();
            $table->string('icon', 45)->nullable();
            $table->boolean('is_faq')->default(0);
            $table->boolean('is_forum')->default(0);
            $table->boolean('is_media')->default(0);
            $table->boolean('is_torrent')->default(0);
            $table->tinyInteger('position')->default(1); // 1 to 125 - maybe used by forum
            $table->integer('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
