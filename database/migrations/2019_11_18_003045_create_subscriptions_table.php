<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forum_id')->index();
            $table->unsignedBigInteger('topic_id')->index()->unique();
            $table->unsignedBigInteger('user_id')->index()->unique();
            $table->boolean('email')->default(0);
            $table->boolean('notify')->default(0);

            $table->foreign('forum_id')->references('id')->on('forums')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('topic_id')->references('id')->on('topics')
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
        Schema::dropIfExists('subscriptions');
    }
}
