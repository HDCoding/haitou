<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('username', 25);
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('multi_choice')->default(0);
            $table->boolean('is_main')->default(1);
            $table->boolean('is_closed')->default(0);
            $table->timestamp('closed_at')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('polls');
    }
}
