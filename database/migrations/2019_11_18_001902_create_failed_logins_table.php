<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('email');
            $table->string('ip', 70);
            $table->string('user_agent')->nullable();
            $table->string('bot')->nullable();
            $table->string('os_family')->nullable();
            $table->string('os')->nullable();
            $table->string('browser_family')->nullable();
            $table->string('browser')->nullable();
            $table->boolean('is_desktop')->default(0);
            $table->boolean('is_mobile')->default(0);
            $table->boolean('is_tablet')->default(0);
            $table->boolean('is_bot')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('failed_logins');
    }
}
