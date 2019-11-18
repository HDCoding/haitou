<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forum_id')->index();
            $table->unsignedBigInteger('topic_id')->index();
            $table->unsignedBigInteger('post_id')->index();
            $table->unsignedBigInteger('user_id')->index();

            $table->string('md5_hash', 35);
            $table->string('sha1_hash', 45);
            $table->string('filename');
            $table->string('mimetype', 45);
            $table->string('extension', 10);
            $table->unsignedInteger('size')->default(0);
            $table->unsignedInteger('downs')->default(0);
            $table->timestamps();

            $table->foreign('forum_id')->references('id')->on('forums')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('topic_id')->references('id')->on('topics')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('post_id')->references('id')->on('posts')
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
        Schema::dropIfExists('attachments');
    }
}
