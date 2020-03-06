<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatroomUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatroom_users', function (Blueprint $table) {
            $table->unsignedBigInteger('chatroom_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->boolean('is_admin')->default(false);
            $table->boolean('can_post')->default(true);
            $table->timestamps();

            $table->primary(['chatroom_id', 'user_id']);

            $table->foreign('chatroom_id')->references('id')
                ->on('chatrooms')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('chatroom_users');
    }
}
