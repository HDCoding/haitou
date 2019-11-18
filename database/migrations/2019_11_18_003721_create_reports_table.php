<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('staff_id')->index()->nullable();
            $table->unsignedBigInteger('calendar_id')->index()->nullable();
            $table->unsignedBigInteger('comment_id')->index()->nullable();
            $table->unsignedBigInteger('member_id')->index()->nullable();
            $table->unsignedBigInteger('post_id')->index()->nullable();
            $table->unsignedBigInteger('torrent_id')->index()->nullable();

            $table->tinyInteger('report_type');
            $table->string('name');
            $table->string('slug');
            $table->text('reason');
            $table->text('solution')->nullable();
            $table->boolean('is_solved')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('staff_id')->references('id')->on('users');

            $table->foreign('calendar_id')->references('id')->on('calendars')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('comment_id')->references('id')->on('comments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('member_id')->references('id')->on('users');

            $table->foreign('post_id')->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('torrent_id')->references('id')->on('torrents')
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
        Schema::dropIfExists('reports');
    }
}
