<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeslotLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeslot_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('freeslot_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('username', 25);
            $table->integer('donated');
            $table->timestamps();

            $table->foreign('freeslot_id')->references('id')->on('freeslots')
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
        Schema::dropIfExists('freeslot_logs');
    }
}
