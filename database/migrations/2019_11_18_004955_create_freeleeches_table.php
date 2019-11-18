<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeleechesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeleeches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('torrent_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->boolean('is_freeleech')->default(0);
            $table->boolean('is_silver')->default(0);
            $table->boolean('is_doubleup')->default(0);
            $table->boolean('is_active')->default(0);
            $table->timestamp('expires_on')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('torrent_id')->references('id')->on('users')
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
        Schema::dropIfExists('freeleeches');
    }
}
