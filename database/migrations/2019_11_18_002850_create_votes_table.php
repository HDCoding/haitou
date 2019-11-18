<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('poll_id')->index();
            $table->unsignedBigInteger('option_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();

            $table->foreign('poll_id')->references('id')->on('polls')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('option_id')->references('id')->on('options')
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
        Schema::dropIfExists('votes');
    }
}
