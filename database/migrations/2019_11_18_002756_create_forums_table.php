<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('last_topic_id')->index()->nullable();
            $table->unsignedBigInteger('last_post_user_id')->index()->nullable();
            $table->tinyInteger('position')->default(1);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('icon', 45)->nullable();
            $table->integer('num_topic')->default(0);
            $table->integer('num_post')->default(0);
            $table->integer('views')->default(0);
            $table->string('last_topic_name')->nullable();
            $table->string('last_topic_slug')->nullable();
            $table->string('last_post_username', 25)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('last_topic_id')->references('id')->on('topics');
            $table->foreign('last_post_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
