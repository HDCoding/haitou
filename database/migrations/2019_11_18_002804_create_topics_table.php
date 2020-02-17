<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forum_id')->index();
            $table->unsignedBigInteger('first_post_user_id')->index();
            $table->unsignedBigInteger('last_post_user_id')->index()->nullable();
            $table->string('first_post_username', 25)->nullable();
            $table->string('last_post_username', 25)->nullable();
            $table->string('name');
            $table->string('slug');
            $table->boolean('is_locked')->default(0);
            $table->boolean('is_pinned')->default(0);
            $table->integer('num_post')->default(0);
            $table->integer('views')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('forum_id')->references('id')->on('forums');
            $table->foreign('first_post_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('topics');
    }
}
