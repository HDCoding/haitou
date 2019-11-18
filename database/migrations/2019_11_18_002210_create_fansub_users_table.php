<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFansubUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fansub_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fansub_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('username', 25);
            $table->string('job', 45);
            $table->boolean('is_admin')->default(0);
            $table->timestamps();

            $table->foreign('fansub_id')->references('id')->on('fansubs')
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
        Schema::dropIfExists('fansub_users');
    }
}
