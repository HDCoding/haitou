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
Route::get('/', 'IndexController@index');

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
Route::middleware(['auth', 'lockscreen'])->group(function () {
    //Site Folder
    Route::namespace('Site')->group(function () {
        // Achievements
        Route::get('achievements', 'AchievementsController@index')->name('achievements');
        //Actors
        Route::get('actors/{id}.{slug}', 'ActorsController@show')->name('actors.show');
        //Bonus
        Route::resource('bonus', 'BonusController')->only(['index', 'store']);
        Route::post('bonus/donate', 'BonusController@donate');
        //Bookmark Save
        Route::post('savebookmark', 'BookmarksController@store')->name('save.bookmark');
        //Bookmark Delete
        Route::delete('deletebookmark/{id}', 'BookmarksController@destroy')->name('delete.bookmark');
        //Calendars
        Route::resource('calendars', 'CalendarsController')->except(['create']);
        //Character Show
        Route::get('characters/{id}.{slug}', 'CharactersController@show')->name('characters.show');
        //Chatbox
        Route::get('chatbox', 'ChatboxController@index')->name('site.chatbox');
        //Save Comments
        Route::resource('comments', 'CommentsController')->except(['index', 'create']);
        //Donates
        Route::get('donates', 'DonatesController@index')->name('site.donates');
        //Fansubs
        Route::get('fansubs', 'FansubsController@index')->name('site.fansubs');
        Route::get('fansub/{id}.{slug}', 'FansubsController@show')->name('fansub.show');
        Route::get('fansub/{id}/edit', 'FansubsController@edit');
        Route::put('fansub/{id}/edit', 'FansubsController@update');
        Route::get('fansub/{id}/members', 'FansubsController@members');
        Route::post('fansub/{fansub_id}/addmembers', 'FansubsController@addMembers')->name('site.fansub.addmember');
        Route::delete('fansub/{member_id}/delmembers', 'FansubsController@delMembers');
        //Faqs
        Route::get('faq', 'FaqsController@index')->name('site.faq');
        //Forum
        Route::prefix('forum')->group(function () {
            //Forum main page
            Route::get('/', 'ForumsController@index')->name('forum');
            //Topics
            Route::get('{id}.{slug}', 'ForumsController@topics')->name('forum.topics');
            //Topic
            Route::get('/topic/{id}.{slug}', 'ForumsController@topic')->name('forum.topic');
            //New topic
            Route::get('/{id}.{slug}/new-topic', 'ForumsController@newTopicForm')->name('new.topic');
            Route::post('/{id}.{slug}/new-topic', 'ForumsController@newTopicPost')->name('post.topic');
            //Edit Post
            Route::get('/topic/{id}.{slug}/post-{postId}/edit', 'ForumsController@postEditForm')->name('post.edit.form');
            Route::put('/topic/{id}.{slug}/post-{postId}/edit', 'ForumsController@postEdit')->name('post.edit');
            //Delete Post
            Route::delete('/post/{postId}', 'ForumsController@postDelete')->name('post.delete');
            //Delete Topic
            Route::delete('/topic/{id}.{slug}', 'ForumsController@topicDelete')->name('topic.delete');
            //Reply
            Route::post('/topic/{id}.{slug}/reply', 'ForumsController@reply')->name('forum.reply');
            // Open/Close Topic
            Route::get('/topic/{id}.{slug}/openclose', 'ForumsController@openCloseTopic')->name('forum_openclose_topic');
            // Pin/Unpin Topic
            Route::get('/topic/{id}.{slug}/pinunpin', 'ForumsController@pinUnpinTopic')->name('forum_pinunpin_topic');
            // Like - Dislike
            Route::get('/like/post/{postId}', 'LikesController@likePost')->name('like.post');
            Route::get('/dislike/post/{postId}', 'LikesController@dislikePost')->name('dislike.post');

            //Search
            Route::get('search', 'ForumsController@search')->name('forum.search');

            //Other
            Route::get('subscriptions', 'ForumsController@subscriptions')->name('forum_subscriptions');
            Route::get('latest/topics', 'ForumsController@latestTopics')->name('forum_latest_topics');
            Route::get('latest/posts', 'ForumsController@latestPosts')->name('forum_latest_posts');

            // Subscription System
            Route::get('subscribe/topic/{route}.{topic}', 'SubscriptionsController@subscribeTopic')->name('subscribe_topic');
            Route::get('unsubscribe/topic/{route}.{topic}', 'SubscriptionsController@unsubscribeTopic')->name('unsubscribe_topic');

            //Poll Add
//        Route::get('/topico/{id}.{slug}/add-poll', 'ForumsController@topicAddPoll')->name('topic.add.poll');
//        Route::post('/topico/{id}.{slug}/add-poll', 'ForumsController@topicSavePoll')->name('topic.save.poll');
        });
        //Home
        Route::get('home', 'HomeController@index')->name('home');
        //Invites
        Route::resource('invites', 'InvitationsController')->only(['index', 'store']);
        Route::get('/resendinvite/{id}', 'InvitationsController@resend')->name('invite.resend');
        //Lotteries
        Route::get('lotteries', 'LotteriesController@index')->name('site.lotteries');
        //Medias
        Route::prefix('media')->group(function () {
            Route::get('{id}.{slug}', 'MediasController@show')->name('media.show');
            //Votar na Media
            Route::post('{id}/vote', 'MediasController@vote')->name('media.vote');
        });
        //Notifications
        Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
        Route::get('notifications/{id}', 'NotificationsController@show')->name('notifications.show');
        Route::get('notification/update/{id}', 'NotificationsController@update')->name('notifications.update');
        Route::get('notification/updateall', 'NotificationsController@updateAll')->name('notifications.updateall');
        Route::get('notification/destroy/{id}', 'NotificationsController@destroy')->name('notifications.destroy');
        Route::get('notification/destroyall', 'NotificationsController@destroyAll')->name('notifications.destroyall');
        //Polls
        Route::prefix('poll')->group(function () {
            Route::get('{id}.{slug}', 'PollsController@show')->name('site.poll.show');
            Route::post('{id}.{slug}', 'PollsController@vote')->name('site.poll.vote');
            Route::get('{id}.{slug}/result', 'PollsController@result')->name('site.poll.results');
        });
        //Reports
        Route::prefix('report')->group(function () {
            Route::post('/', 'ReportsController@store')->name('store.report');
            Route::get('calendar/{id}', 'ReportsController@calendar')->name('calendar.report');
            Route::get('comment/{id}', 'ReportsController@comment')->name('comment.report');
            Route::get('post/{id}', 'ReportsController@post')->name('post.report');
            Route::get('torrent/{id}', 'ReportsController@torrent')->name('torrent.report');
            Route::get('user/{id}', 'ReportsController@user')->name('user.report');
        });
        //Requests
        Route::resource('freeslots', 'FreeSlotsController')->only(['index', 'store']);
        //Rules
        Route::get('rules', 'RulesController@index')->name('site.rules');
        //Studios
        Route::get('studio/{id}.{slug}', 'StudiosController@show')->name('studio.show');
        //Torrents
        Route::resource('torrents', 'TorrentsController')->except(['show']);
        Route::prefix('torrent')->group(function () {
            //Download file
            Route::get('/{id}/download', 'TorrentsController@download')->name('torrent.download');
            //Page info
            Route::get('{id}.{slug}', 'TorrentsController@show')->name('torrent.show');
            //Thanks
            Route::post('/{id}/thanks', 'TorrentsController@thanks')->name('torrent.thanks');
            //ReSeed
            Route::get('/{id}/reseed', 'TorrentsController@reSeed')->name('torrent.reseed');
            //Uploads
            Route::get('uploads', 'TorrentsController@uploads')->name('torrent.uploads');
        });
        //Users
        Route::get('users', 'UsersController@index')->name('site.users');
        Route::get('user/{slug}', 'UsersController@profile')->name('user.profile');
        Route::get('user/{slug}/friends', 'UsersController@friends')->name('user.friends');
        Route::get('user/{slug}/achievements', 'UsersController@achievements')->name('user.achievements');
        //Update/Edit Account
        Route::get('user/edit/account', 'UsersController@formAccount')->name('edit.profile');
        Route::post('user/edit/account', 'UsersController@postAccount')->name('post.profile');
        //Update/Edit Password
        Route::get('user/edit/password', 'UsersController@formPassword')->name('edit.password');
        Route::post('user/edit/password', 'UsersController@postPassword')->name('post.password');
        //Update/Edit Privacy
        Route::get('user/edit/privacy', 'UsersController@formPrivacy')->name('edit.privacy');
        Route::post('user/edit/privacy', 'UsersController@postPrivacy')->name('post.privacy');
        //Update/Edit Setting
        Route::get('user/edit/social', 'UsersController@formSocial')->name('edit.social');
        Route::post('user/edit/social', 'UsersController@postSocial')->name('post.social');
        //Update/Edit Passkey
        Route::get('user/edit/passkey', 'UsersController@formPasskey')->name('edit.passkey');
        Route::post('user/edit/passkey', 'UsersController@postPasskey')->name('post.passkey');
        //Update/Edit Email
        Route::get('user/edit/email', 'UsersController@formEmail')->name('edit.email');
        Route::post('user/edit/email', 'UsersController@postEmail')->name('post.email');

        //User Bookmark
        Route::prefix('bookmark')->group(function () {
            //Actors
            Route::get('actors', 'BookmarksController@actors')->name('bookmark.actors');
            //Characters
            Route::get('characters', 'BookmarksController@characters')->name('bookmark.characters');
            //Medias
            Route::get('medias', 'BookmarksController@medias')->name('bookmark.medias');
        });

        //Search in all sites
        Route::post('search', 'SearchesController@search')->name('search');
    });

//Staff Folder
    Route::namespace('Staff')->group(function () {
        //Staff panel prefix
        Route::prefix('staff')->group(function () {
            //Staff panel
            Route::get('/', 'StaffController@index')->name('staff');
            //Achievements
            Route::get('achievements', 'AchievementsController@index')->name('staff.achievements');
            //Actors
            Route::resource('actors', 'ActorsController')->except(['show']);
            //Backups
            Route::get('backups', 'BackupsController@index')->name('staff.backups');
            Route::post('backup/create-full', 'BackupsController@create');
            Route::post('backup/create-files', 'BackupsController@createFilesOnly');
            Route::post('backup/create-db', 'BackupsController@createDatabaseOnly');
            Route::get('backup/download/{file_name?}', 'BackupsController@download');
            Route::post('backup/delete', 'BackupsController@delete');
            //Bonus
            Route::resource('bonus', 'BonusController')->except(['show']);
            Route::put('bonus/{id}/update', 'BonusController@enableDisable')->name('bonus.enabled');
            //Calendars
            Route::resource('calendars', 'CalendarsController')->only(['index', 'update', 'destroy']);
            //Categories
            Route::resource('categories', 'CategoriesController')->except(['show']);
            Route::put('category-order/{id}', 'CategoriesController@order')->name('category.order');
            //Characters
            Route::resource('characters', 'CharactersController')->except(['show']);
            //Cheaters
            Route::get('cheaters', 'CheatersController@index')->name('staff.cheaters');
            //Commands
            Route::get('commands', 'CommandsController@index')->name('staff.commands');
            Route::get('command/maintance-enable', 'CommandsController@maintanceEnable');
            Route::get('command/maintance-disable', 'CommandsController@maintanceDisable');
            Route::get('command/clear-cache', 'CommandsController@clearCache');
            Route::get('command/clear-view-cache', 'CommandsController@clearView');
            Route::get('command/clear-route-cache', 'CommandsController@clearRoute');
            Route::get('command/clear-config-cache', 'CommandsController@clearConfig');
            Route::get('command/clear-all-cache', 'CommandsController@clearAllCache');
            Route::get('command/set-all-cache', 'CommandsController@setAllCache');
            Route::get('command/clear-compiled', 'CommandsController@clearCompiled');
            Route::get('command/test-email', 'CommandsController@testEmail');
            //Failed Logins
            Route::get('failedlogins', 'FailedLoginsController@index')->name('staff.failedlogins');
            //Fansubs
            Route::resource('fansubs', 'FansubsController')->except(['show']);
            //Fansub members
            Route::get('fansub/{id}/members', 'FansubsController@members');
            Route::post('fansub/{fansub_id}/addmembers', 'FansubsController@addMembers')->name('staff.fansub.addmember');
            Route::delete('fansub/{member_id}/delmembers', 'FansubsController@delMembers');
            //Faqs
            Route::resource('faqs', 'FaqsController');
            Route::put('faq/{id}/update', 'FaqsController@enableDisable');
            //Forums
            Route::resource('forums', 'ForumsController');
            Route::put('forum-order', 'ForumsController@order')->name('forum.order');
            //Forum Add Mods
            Route::get('forum/{id}/addmod', 'ForumsController@formAddMod')->name('forum.formaddmod');
            Route::post('forum/{id}/addmod', 'ForumsController@postAddMod')->name('forum.addmod');
            //Forum Edit Mods
            Route::get('forum/{id}/editmod', 'ForumsController@formEditMod')->name('forum.formeditmod');
            Route::post('forum/{id}/editmod', 'ForumsController@postEditMod')->name('forum.editmod');
            //Genres
            Route::resource('genres', 'GenresController')->except(['create', 'show', 'edit']);
            //Groups
            Route::resource('groups', 'GroupsController')->except(['show']);
            //Icons
            Route::get('icon/fontawesome', 'IconsController@fontawesome')->name('staff.icons.fontawesome');
            Route::get('icon/ionicons', 'IconsController@ionicons')->name('staff.icons.ionicons');
            Route::get('icon/linearicons', 'IconsController@linearicons')->name('staff.icons.linearicons');
            Route::get('icon/openiconic', 'IconsController@openiconic')->name('staff.icons.open-iconic');
            Route::get('icon/strokeicons', 'IconsController@strokeicons')->name('staff.icons.stroke-icons-7');
            //Logs
            //Route::get('logs', 'LogsController@index')->name('staff.logs');
            //Lotteries
            Route::resource('lotteries', 'LotteriesController');
            //Medias
            Route::resource('medias', 'MediasController')->except(['show']);
            //Medias Casts
            Route::get('media/{id}/casts', 'MediasController@casts');
            Route::post('media/{id}/casts', 'MediasController@castSave');
            Route::delete('media/cast/{id}/delete', 'MediasController@castDelete');
            //Moods
            Route::resource('moods', 'MoodsController')->only(['index', 'update']);
            //News
            Route::resource('news', 'NewsController')->except(['show']);
            //Polls
            Route::resource('polls', 'PollsController');
            Route::put('poll/{id}/update', 'PollsController@openClose'); //Enable/Disable
            //Poll Options
            Route::get('poll/{id}/options/add', 'PollsController@formAddOptions'); //Add
            Route::post('poll/options/add', 'PollsController@postAddOptions');
            Route::get('poll/{id}/options/remove', 'PollsController@formRemoveOptions'); //Remove
            Route::post('poll/options/remove', 'PollsController@postRemoveOptions');
            //Reports
            Route::resource('reports', 'ReportsController')->only(['index', 'show', 'update']);
            //Freeslots
            Route::resource('freeslots', 'FreeSlotsController')->except(['show']);
            //Rules
            Route::resource('rules', 'RulesController')->except(['show']);
            //Settings
            Route::resource('settings', 'SettingsController')->only(['index', 'store']);
            //Studios
            Route::resource('studios', 'StudiosController')->except(['show']);
            //Torrents
            Route::resource('torrents', 'TorrentsController')->except(['create', 'store', 'show']);
            //Traffics
            Route::prefix('traffics')->group(function () {
                //Index
                Route::get('/', 'TrafficsController@index')->name('traffic.index');
                //Hourly
                Route::get('hourly', 'TrafficsController@hourly')->name('traffic.hourly');
                //Daily
                Route::get('daily', 'TrafficsController@daily')->name('traffic.daily');
                //Monthly
                Route::get('monthly', 'TrafficsController@monthly')->name('traffic.monthly');
                //Top10
                Route::get('top10', 'TrafficsController@topten')->name('traffic.topten');
            });
            //Torrent Options
            Route::put('torrent/{id}/freeleech', 'TorrentsController@freeleech');
            Route::put('torrent/{id}/silver', 'TorrentsController@silver');
            Route::put('torrent/{id}/doubleup', 'TorrentsController@doubleup');
            //Users
            Route::resource('users', 'UsersController')->except(['create', 'store', 'show']);
            //Ban user
            Route::get('user/{id}/ban', 'UsersController@formBan');
            Route::post('user/banning', 'UsersController@postBan');
            //Suspend user
            Route::get('user/{id}/suspend', 'UsersController@formSuspend');
            Route::post('user/suspend', 'UsersController@postSuspend');
            //Warn user
            Route::get('user/{id}/warn', 'UsersController@formWarn');
            Route::post('user/warning', 'UsersController@postWarn');
            //Notes user
            Route::get('user/{id}/notes', 'UsersController@formNote')->name('staff.user.notes');
            Route::post('user/notes', 'UsersController@postNote');
            //Search user
            Route::post('user/search', 'UsersController@search');
            //Permissions
            Route::get('user/{id}/permissions', 'UsersController@formPermission')->name('staff.user.permissions');
            Route::post('user/{id}/updatepermission', 'UsersController@updatePermission');
            //Visitors
            Route::get('visitors', 'VisitorsController@index')->name('staff.visitors');
        });
    });
});
