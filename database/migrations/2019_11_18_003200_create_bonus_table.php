<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('cost');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->tinyInteger('bonus_type'); // 0 = download, 1 = upload, 2 = freeleech, 3 = warning, 4 = invite, 5 = slots
            $table->tinyInteger('bytes')->nullable(); // 0 = MB, 1 = GB, 2 = TB
            $table->boolean('is_enabled')->default(0);
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
        Schema::dropIfExists('bonus');
    }
}
