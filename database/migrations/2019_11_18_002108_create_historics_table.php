<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('torrent_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('info_hash', 45);
            $table->string('client', 70)->nullable();
            $table->unsignedBigInteger('uploaded')->default(0);
            $table->unsignedBigInteger('mod_uploaded')->default(0);
            $table->unsignedBigInteger('real_uploaded')->default(0);
            $table->unsignedBigInteger('downloaded')->default(0);
            $table->unsignedBigInteger('mod_downloaded')->default(0);
            $table->unsignedBigInteger('real_downloaded')->default(0);
            $table->boolean('is_seeder')->default(0);
            $table->boolean('is_leecher')->default(0);
            $table->boolean('is_active')->default(0);
            $table->boolean('is_released')->default(0);
            $table->unsignedBigInteger('seed_time')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('torrent_id')->references('id')->on('torrents')
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
        Schema::dropIfExists('historic');
    }
}
