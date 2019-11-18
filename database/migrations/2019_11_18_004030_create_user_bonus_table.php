<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bonus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bonus_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->unsignedInteger('cost');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('bonus_id')->references('id')->on('bonus');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_bonus');
    }
}
