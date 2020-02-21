<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('mood_id')->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->unsignedBigInteger('state_id')->index();

            $table->string('username', 25)->unique();
            $table->string('slug', 25)->unique();
            $table->string('email', 70)->unique();
            $table->string('password', 100);

            $table->tinyInteger('status')->default(1); //1 = pendent, 2 = confirmed, 3 = suspension, 4 = banned

            $table->unsignedBigInteger('uploaded')->default(0);
            $table->unsignedBigInteger('downloaded')->default(0);

            $table->unsignedInteger('points')->default(0);
            $table->unsignedInteger('experience')->default(0);
            $table->unsignedInteger('reputation')->default(0);

            $table->integer('num_event')->default(0);
            $table->integer('num_comment')->default(0);
            $table->integer('num_invite')->default(0); //only the accepted
            $table->integer('num_post')->default(0);
            $table->integer('num_report')->default(0);
            $table->integer('num_thank')->default(0);
            $table->integer('num_topic')->default(0);

            $table->unsignedSmallInteger('invites')->default(5);
            $table->unsignedTinyInteger('max_slots')->default(3); //max torrents downloading same time

            $table->string('passkey', 45)->unique();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('info')->nullable();
            $table->string('title')->nullable();
            $table->text('signature')->nullable();

            $table->date('birthday')->nullable();

            $table->boolean('is_warned')->default(0);
            $table->boolean('is_donor')->default(0);
            $table->boolean('birth_gifted')->default(0);
            $table->boolean('readed_rules')->default(0);

            $table->unsignedInteger('time_online')->default(0);

            $table->string('css_style', 45)->nullable();
            $table->string('code', 100)->nullable();

            $table->integer('views')->default(0);

            $table->boolean('show_achievements')->default(1);

            $table->boolean('show_mood')->default(1);
            $table->boolean('show_state')->default(1);
            $table->boolean('show_group')->default(1);

            $table->boolean('show_downloaded')->default(1);
            $table->boolean('show_uploaded')->default(1);

            $table->boolean('show_profile')->default(1);
            $table->boolean('show_profile_points')->default(1);
            $table->boolean('show_profile_level')->default(1);
            $table->boolean('show_profile_avatar')->default(1);
            $table->boolean('show_profile_cover')->default(1);
            $table->boolean('show_profile_info')->default(1);
            $table->boolean('show_profile_title')->default(1);
            $table->boolean('show_profile_signature')->default(1);
            $table->boolean('show_profile_birthday')->default(1);
            $table->boolean('show_profile_social_links')->default(1);

            $table->boolean('show_profile_warning')->default(1);

            $table->boolean('show_forum_signatures')->default(1);

            $table->boolean('receive_email')->default(1);

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('pinterest')->nullable();

            $table->tinyInteger('torrents_per_page')->default(15);
            $table->tinyInteger('topics_per_page')->default(15);
            $table->tinyInteger('posts_per_page')->default(15);

            $table->rememberToken();
            $table->timestamp('last_action')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->timestamps();

            $table->foreign('mood_id')->references('id')->on('moods');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
