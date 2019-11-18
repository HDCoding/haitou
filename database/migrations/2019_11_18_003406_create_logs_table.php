<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->text('content');
            $table->string('ip', 70);
            $table->string('user_agent', 15)->nullable();
            $table->string('system', 15)->nullable();
            $table->boolean('is_mobile')->default(0);
            $table->boolean('is_tablet')->default(0);
            $table->boolean('is_desktop')->default(0);
            $table->boolean('is_staff')->default(0);
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
        Schema::dropIfExists('logs');
    }
}
