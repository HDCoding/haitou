<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotteries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_if')->index();

            $table->string('name');
            $table->string('slug');
            $table->string('groups')->nullable(); // [] grupos que podem participar
            $table->string('numbers'); // [] numeros gerados aleatoriamente

            // tipo de premio
            $table->boolean('is_enable')->default(0);
            $table->boolean('is_vip')->default(0);
            $table->boolean('is_upload')->default(0);
            $table->boolean('is_points')->default(0);
            $table->boolean('is_invites')->default(0);
            $table->boolean('is_share')->default(0);

            $table->tinyInteger('vip_days')->default(0); // 0 to 125
            $table->tinyInteger('ticket_per_user')->default(1); // 0 to 125
            $table->tinyInteger('max_select')->default(0); // 0 to 125 // total de numeros que podem ser escolhidos na cartela MIN 6
            $table->tinyInteger('max_numbers')->default(0); // 0 to 125 // total de numeros na cartela, ex: de 1 a 60
            $table->tinyInteger('invites')->default(0); // 0 to 125
            $table->smallInteger('ticket_cost')->default(0); // custo de cada ticket, desconta dos pontos do usuario
            $table->smallInteger('win_percent')->default(0); // nao lembro pra que era isso
            $table->unsignedInteger('upload')->default(0);
            $table->unsignedInteger('points')->default(0);

            $table->text('description')->nullable();

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();

            $table->foreign('user_if')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotteries');
    }
}
