<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Index
Route::get('/', 'IndexesController@index')->name('index');
//Legal
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('privacy', 'IndexController@privacy')->name('privacy');

//Announce
Route::get('announce/{passkey}', 'AnnounceController@announce')->name('announce');

//Auth
Auth::routes(['verify' => false]);

//Auth Folder
Route::namespace('Auth')->group(function () {
    //Activate account
    Route::get('activations/{code}/new', 'ActivationController@newAccount')->name('new.activation');
    //Update Email
    Route::get('activations/{code}/update', 'ActivationController@updateEmail')->name('update.activation');
    //Accept invitations
    Route::get('invitations/{code}', 'InvitationController@code')->name('invitations');
    Route::post('invitations', 'InvitationController@signUp');
    //Lock Screen
    Route::get('lockscreen', 'LockscreenController@lock')->name('lockscreen');
    Route::post('unlockscreen', 'LockscreenController@unlock')->name('unlockscreen');
});

//Middleware
//Route::middleware(['auth', 'lockscreen'])->group(function () {
//Site Folder
Route::namespace('Site')->group(function () {
    // Achievements
    Route::get('achievements', 'AchievementController@index')->name('achievements');
    //Actors
    Route::get('actors/{id}.{slug}', 'ActorController@show')->name('actors.show');
    //Bonus
    Route::resource('bonus', 'BonusController')->only(['index', 'store']);
    Route::post('bonus/donate', 'BonusController@donate');
    //Bookmark Save
    Route::post('savebookmark', 'BookmarkController@store')->name('save.bookmark');
    //Bookmark Delete
    Route::delete('deletebookmark/{id}', 'BookmarkController@destroy')->name('delete.bookmark');
    //Calendars
    Route::resource('calendars', 'CalendarController')->except(['create']);
    //Character Show
    Route::get('characters/{id}.{slug}', 'CharacterController@show')->name('characters.show');
    //Chatbox
    Route::get('chatbox', 'ChatboxController@index')->name('site.chatbox');
    //Save Comments
    Route::resource('comments', 'CommentController')->except(['index', 'create']);
    //Donates
    Route::get('donates', 'DonateController@index')->name('site.donates');
    //Fansubs
    Route::get('fansubs', 'FansubController@index')->name('site.fansubs');
    Route::get('fansub/{id}.{slug}', 'FansubController@show')->name('fansub.show');
    //Faqs
    Route::get('faqs', 'FaqController@index')->name('site.faqs');
    //Forum
    Route::prefix('forum')->group(function () {
        //Forum main page
        Route::get('/', 'ForumController@index')->name('forum');
        //Topics
        Route::get('{id}.{slug}', 'ForumController@topics')->name('forum.topics');
        //Topic
        Route::get('/topic/{id}.{slug}', 'ForumController@topic')->name('forum.topic');
        //New topic
        Route::get('/{id}.{slug}/new-topic', 'ForumController@newTopicForm')->name('new.topic');
        Route::post('/{id}.{slug}/new-topic', 'ForumController@newTopicPost')->name('post.topic');
        //Edit Post
        Route::get('/topic/{id}.{slug}/post-{postId}/edit', 'ForumController@postEditForm')->name('post.edit.form');
        Route::put('/topic/{id}.{slug}/post-{postId}/edit', 'ForumController@postEdit')->name('post.edit');
        //Delete Post
        Route::delete('/post/{postId}', 'ForumController@postDelete')->name('post.delete');
        //Delete Topic
        Route::delete('/topic/{id}.{slug}', 'ForumController@topicDelete')->name('topic.delete');
        //Reply
        Route::post('/topic/{id}.{slug}/reply', 'ForumController@reply')->name('forum.reply');
        // Open/Close Topic
        Route::get('/topic/{id}.{slug}/openclose', 'ForumController@openCloseTopic')->name('forum_openclose_topic');
        // Pin/Unpin Topic
        Route::get('/topic/{id}.{slug}/pinunpin', 'ForumController@pinUnpinTopic')->name('forum_pinunpin_topic');
        // Like - Dislike
        Route::get('/like/post/{postId}', 'LikeController@likePost')->name('like.post');
        Route::get('/dislike/post/{postId}', 'LikeController@dislikePost')->name('dislike.post');

        //Search
        Route::get('search', 'ForumController@search')->name('forum.search');

        //Other
        Route::get('subscriptions', 'ForumController@subscriptions')->name('forum_subscriptions');
        Route::get('latest/topics', 'ForumController@latestTopics')->name('forum_latest_topics');
        Route::get('latest/posts', 'ForumController@latestPosts')->name('forum_latest_posts');

        // Subscription System
        Route::get('subscribe/topic/{route}.{topic}', 'SubscriptionController@subscribeTopic')->name('subscribe_topic');
        Route::get('unsubscribe/topic/{route}.{topic}', 'SubscriptionController@unsubscribeTopic')->name('unsubscribe_topic');

        //Poll Add
//        Route::get('/topico/{id}.{slug}/add-poll', 'ForumController@topicAddPoll')->name('topic.add.poll');
//        Route::post('/topico/{id}.{slug}/add-poll', 'ForumController@topicSavePoll')->name('topic.save.poll');
    });
    //Home
    Route::get('home', 'HomeController@index')->name('home');
    //Invites
    Route::resource('invites', 'InvitationController')->only(['index', 'store']);
    Route::get('/resendinvite/{id}', 'InvitationController@resend')->name('invite.resend');
    //Lotteries
    Route::get('lotteries', 'LotteryController@index')->name('site.lotteries');
    //Medias
    Route::prefix('media')->group(function () {
        Route::get('{id}.{slug}', 'MediaController@show')->name('media.show');
        //Votar na Media
        Route::post('{id}/vote', 'MediaController@vote')->name('media.vote');
    });
    //Notifications
    Route::get('notifications', 'NotificationController@index')->name('notifications.index');
    Route::get('notifications/{id}', 'NotificationController@show')->name('notifications.show');
    Route::get('notification/update/{id}', 'NotificationController@update')->name('notifications.update');
    Route::get('notification/updateall', 'NotificationController@updateAll')->name('notifications.updateall');
    Route::get('notification/destroy/{id}', 'NotificationController@destroy')->name('notifications.destroy');
    Route::get('notification/destroyall', 'NotificationController@destroyAll')->name('notifications.destroyall');
    //Polls
    Route::prefix('poll')->group(function () {
        Route::get('{id}.{slug}', 'PollController@show')->name('poll.show');
        Route::post('{id}.{slug}', 'PollController@vote')->name('poll.vote');
        Route::get('{id}.{slug}/result', 'PollController@result')->name('poll.results');
    });
    //Reports
    Route::prefix('report')->group(function () {
        Route::post('/', 'ReportController@store')->name('store.report');
        Route::get('calendar/{id}', 'ReportController@calendar')->name('calendar.report');
        Route::get('comment/{id}', 'ReportController@comment')->name('comment.report');
        Route::get('post/{id}', 'ReportController@post')->name('post.report');
        Route::get('torrent/{id}', 'ReportController@torrent')->name('torrent.report');
        Route::get('user/{id}', 'ReportController@user')->name('user.report');
    });
    //Requests
    Route::resource('requests', 'RequestController')->only(['index', 'store']);
    //Rules
    Route::get('rules', 'RuleController@index')->name('site.rules');
    //Studios
    Route::get('studio/{id}.{slug}', 'StudioController@show')->name('studio.show');
    //Torrents
    Route::resource('torrents', 'TorrentController')->except(['show']);
    Route::prefix('torrent')->group(function () {
        //Download file
        Route::get('/{id}/download', 'TorrentController@download')->name('torrent.download');
        //Page info
        Route::get('{id}.{slug}', 'TorrentController@show')->name('torrent.show');
        //Thanks
        Route::post('/{id}/thanks', 'TorrentController@thanks')->name('torrent.thanks');
        //ReSeed
        Route::get('/{id}/reseed', 'TorrentController@reSeed')->name('torrent.reseed');
        //Uploads
        Route::get('uploads', 'TorrentController@uploads')->name('torrent.uploads');
    });
    //Users
    Route::get('users', 'UserController@index')->name('site.users');
    Route::get('user/{slug}', 'UserController@profile')->name('user.profile');
    Route::get('user/{slug}/friends', 'UserController@friends')->name('user.friends');
    Route::get('user/{slug}/achievements', 'UserController@achievements')->name('user.achievements');
    //Update/Edit Account
    Route::get('user/edit/account', 'UserController@formAccount')->name('edit.profile');
    Route::post('user/edit/account', 'UserController@postAccount')->name('post.profile');
    //Update/Edit Password
    Route::get('user/edit/password', 'UserController@formPassword')->name('edit.password');
    Route::post('user/edit/password', 'UserController@postPassword')->name('post.password');
    //Update/Edit Privacy
    Route::get('user/edit/privacy', 'UserController@formPrivacy')->name('edit.privacy');
    Route::post('user/edit/privacy', 'UserController@postPrivacy')->name('post.privacy');
    //Update/Edit Setting
    Route::get('user/edit/social', 'UserController@formSocial')->name('edit.social');
    Route::post('user/edit/social', 'UserController@postSocial')->name('post.social');
    //Update/Edit Passkey
    Route::get('user/edit/passkey', 'UserController@formPasskey')->name('edit.passkey');
    Route::post('user/edit/passkey', 'UserController@postPasskey')->name('post.passkey');
    //Update/Edit Email
    Route::get('user/edit/email', 'UserController@formEmail')->name('edit.email');
    Route::post('user/edit/email', 'UserController@postEmail')->name('post.email');

    //Friendship
    Route::get('friendships', 'FriendshipController@friendships')->name('friendships');
    Route::get('friends', 'FriendshipController@friends')->name('friends');
    Route::get('befriend/{id}', 'FriendshipController@befriend')->name('befriend');
    Route::get('unfriend/{id}', 'FriendshipController@unfriend')->name('unfriend');
    Route::get('acceptFriend/{id}', 'FriendshipController@acceptFriend')->name('acceptFriend');
    Route::get('denyFriend/{id}', 'FriendshipController@denyFriend')->name('denyFriend');
    Route::get('blockFriend/{id}', 'FriendshipController@blockFriend')->name('blockFriend');
    Route::get('unblockFriend/{id}', 'FriendshipController@unblockFriend')->name('unblockFriend');

    //User Bookmark
    Route::prefix('bookmark')->group(function () {
        //Actors
        Route::get('actors', 'BookmarkController@actors')->name('bookmark.actors');
        //Characters
        Route::get('characters', 'BookmarkController@characters')->name('bookmark.characters');
        //Medias
        Route::get('medias', 'BookmarkController@medias')->name('bookmark.medias');
    });

    //Search in all sites
    Route::post('search', 'HomeController@search')->name('search');
});

//Staff Folder
Route::namespace('Staff')->group(function () {
    //Staff panel prefix
    Route::prefix('staff')->group(function () {
        //Staff panel
        Route::get('/', 'StaffController@index')->name('staff');
        //Achievements
        Route::get('achievements', 'AchievementController@index')->name('staff.achievements');
        //Actors
        Route::resource('actors', 'ActorController')->except(['show']);
        //Backups
        Route::get('backups', 'BackupController@index')->name('staff.backups');
        Route::post('backup/create-full', 'BackupController@create');
        Route::post('backup/create-files', 'BackupController@createFilesOnly');
        Route::post('backup/create-db', 'BackupController@createDatabaseOnly');
        Route::get('backup/download/{file_name?}', 'BackupController@download');
        Route::post('backup/delete', 'BackupController@delete');
        //Bonus
        Route::resource('bonus', 'BonusController')->except(['show']);
        Route::put('bonus/{id}/update', 'BonusController@enableDisable')->name('bonus.enabled');
        //Calendars
        Route::resource('calendars', 'CalendarController')->only(['index', 'update', 'destroy']);
        //Categories
        Route::resource('categories', 'CategoryController')->except(['show']);
        Route::put('category-order/{id}', 'CategoryController@order')->name('category.order');
        //Characters
        Route::resource('characters', 'CharacterController')->except(['show']);
        //Cheaters
        Route::get('cheaters', 'CheaterController@index')->name('staff.cheaters');
        //Commands
        Route::get('commands', 'CommandController@index')->name('staff.commands');
        Route::get('command/maintance-enable', 'CommandController@maintanceEnable');
        Route::get('command/maintance-disable', 'CommandController@maintanceDisable');
        Route::get('command/clear-cache', 'CommandController@clearCache');
        Route::get('command/clear-view-cache', 'CommandController@clearView');
        Route::get('command/clear-route-cache', 'CommandController@clearRoute');
        Route::get('command/clear-config-cache', 'CommandController@clearConfig');
        Route::get('command/clear-all-cache', 'CommandController@clearAllCache');
        Route::get('command/set-all-cache', 'CommandController@setAllCache');
        Route::get('command/clear-compiled', 'CommandController@clearCompiled');
        Route::get('command/test-email', 'CommandController@testEmail');
        //Failed Logins
        Route::get('failedlogins', 'FailedLoginController@index')->name('staff.failedlogins');
        //Fansubs
        Route::resource('fansubs', 'FansubController')->except(['show']);
        //Fansub members
        Route::get('fansub/{id}/members', 'FansubUsersController@members');
        Route::post('fansub/addmembers', 'FansubUsersController@addMembers');
        Route::delete('fansub/{member_id}/delmembers', 'FansubUsersController@delMembers');
        //Faqs
        Route::resource('faqs', 'FaqController');
        Route::put('faq/{id}/update', 'FaqController@enableDisable');
        //Forums
        Route::resource('forums', 'ForumController');
        Route::put('forum-order', 'ForumController@order')->name('forum.order');
        //Forum Add Mods
        Route::get('forum/{id}/addmod', 'ForumController@formAddMod')->name('forum.formaddmod');
        Route::post('forum/{id}/addmod', 'ForumController@postAddMod')->name('forum.addmod');
        //Forum Edit Mods
        Route::get('forum/{id}/editmod', 'ForumController@formEditMod')->name('forum.formeditmod');
        Route::post('forum/{id}/editmod', 'ForumController@postEditMod')->name('forum.editmod');
        //Genres
        Route::resource('genres', 'GenreController')->except(['create', 'show', 'edit']);
        //Icons
        Route::get('icons', 'IconController@index')->name('staff.icons');
        Route::get('icon/ionicons', 'IconController@ionicons')->name('staff.icons.ionicons');
        Route::get('icon/linearicons', 'IconController@linearicons')->name('staff.icons.linearicons');
        Route::get('icon/open-iconic', 'IconController@openIconic')->name('staff.icons.open-iconic');
        Route::get('icon/stroke-icons-7', 'IconController@peIcon7Stroke')->name('staff.icons.stroke-icons-7');
        //Logs
        //Route::get('logs', 'LogController@index')->name('staff.logs');
        //Lotteries
        Route::resource('lotteries', 'LotteryController');
        //Medias
        Route::resource('medias', 'MediaController')->except(['show']);
        //Medias Casts
        Route::get('media/{id}/casts', 'MediaController@casts');
        Route::post('media/{id}/casts', 'MediaController@castSave');
        Route::delete('media/cast/{id}/delete', 'MediaController@castDelete');
        //Moods
        Route::resource('moods', 'MoodController')->only(['index', 'update']);
        //News
        Route::resource('news', 'NewsController')->except(['show']);
        //Polls
        Route::resource('polls', 'PollController');
        Route::put('poll/{id}/update', 'PollController@openClose'); //Enable/Disable
        //Poll Options
        Route::get('poll/{id}/options/add', 'PollController@formAddOptions'); //Add
        Route::post('poll/options/add', 'PollController@postAddOptions');
        Route::get('poll/{id}/options/remove', 'PollController@formRemoveOptions'); //Remove
        Route::post('poll/options/remove', 'PollController@postRemoveOptions');
        //Reports
        Route::resource('reports', 'ReportController')->only(['index', 'show', 'update']);
        //Requests
        Route::resource('requests', 'RequestController')->only(['index', 'update']);
        Route::post('request/enableDisable', 'RequestController@enableDisable');
        //Roles
        Route::resource('roles', 'RoleController')->except(['show']);
        //Rules
        Route::resource('rules', 'RuleController')->except(['show']);
        //Settings
        Route::resource('settings', 'SettingController')->only(['index', 'update']);
        //Studios
        Route::resource('studios', 'StudioController')->except(['show']);
        //Torrents
        Route::resource('torrents', 'TorrentController')->except(['create', 'store', 'show']);
        //Traffics
        Route::prefix('traffics')->group(function () {
            //Index
            Route::get('/', 'TrafficController@index')->name('traffic.index');
            //Hourly
            Route::get('hourly', 'TrafficController@hourly')->name('traffic.hourly');
            //Daily
            Route::get('daily', 'TrafficController@daily')->name('traffic.daily');
            //Monthly
            Route::get('monthly', 'TrafficController@monthly')->name('traffic.monthly');
            //Top10
            Route::get('top10', 'TrafficController@topten')->name('traffic.topten');
        });
        //Torrent Options
        Route::put('torrent/{id}/freeleech', 'TorrentController@freeleech');
        Route::put('torrent/{id}/silver', 'TorrentController@silver');
        Route::put('torrent/{id}/doubleup', 'TorrentController@doubleup');
        //Users
        Route::resource('users', 'UserController')->except(['create', 'store', 'show']);
        //Ban user
        Route::get('user/{id}/ban', 'UserController@formBan');
        Route::post('user/ban', 'UserController@postBan');
        //Suspend user
        Route::get('user/{id}/suspend', 'UserController@formSuspend');
        Route::post('user/suspend', 'UserController@postSuspend');
        //Warn user
        Route::get('user/{id}/warn', 'UserController@formWarn');
        Route::post('user/warn', 'UserController@postWarn');
        //Notes user
        Route::get('user/{id}/notes', 'UserController@formNote')->name('staff.user.notes');
        Route::post('user/notes', 'UserController@postNote');
        //Search user
        Route::post('user/search', 'UserController@search');
        //Permissions
        Route::get('user/{id}/permissions', 'UserController@formPermission')->name('staff.user.permissions');
        Route::post('user/{id}/updatepermission', 'UserController@updatePermission');
        //Visitors
        Route::get('visitors', 'VisitorController@index')->name('staff.visitors');
    });
});
//});
