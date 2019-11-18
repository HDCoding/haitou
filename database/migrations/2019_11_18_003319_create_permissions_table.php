<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forum_id')->index();
            $table->unsignedBigInteger('group_id')->index();

            $table->boolean('view_forum');
            $table->boolean('read_topic');
            $table->boolean('reply_topic');
            $table->boolean('start_topic');

            $table->foreign('forum_id')->references('id')->on('forums')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('group_id')->references('id')->on('groups')
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
        Schema::dropIfExists('permissions');
    }
}
