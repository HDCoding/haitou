<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lottery_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('numbers');
            $table->tinyInteger('total_num_found')->default(0); //total numeros encontrados
            $table->timestamps();

            $table->foreign('lottery_id')->references('id')->on('lotteries')
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
        Schema::dropIfExists('lottery_winners');
    }
}
