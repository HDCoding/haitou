<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeslots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('required')->default(0);
            $table->integer('actual')->default(0);
            $table->tinyInteger('days')->default(0); //min 1 - max 125
            $table->boolean('is_freeleech')->default(0);
            $table->boolean('is_silver')->default(0);
            $table->boolean('is_doubleup')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freeslots');
    }
}
