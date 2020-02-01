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
Route::get('terms', 'IndexController@terms');
Route::get('privacy', 'IndexController@privacy');

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
    Route::post('invitations', 'InvitationController@register');

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
        Route::get('actor/{id}.{slug}', 'ActorsController@show')->name('actor.show');

        //Bonus
        Route::resource('bonus', 'BonusController')->only(['index', 'store']);
        Route::post('bonus/donate', 'BonusController@donate');

        //Bookmark
        Route::prefix('bookmark')->group(function () {
            //Actors
            Route::get('actors', 'BookmarksController@actors')->name('bookmark.actors');
            //Characters
            Route::get('characters', 'BookmarksController@characters')->name('bookmark.characters');
            //Medias
            Route::get('medias', 'BookmarksController@medias')->name('bookmark.medias');
            //Save
            Route::post('save', 'BookmarksController@store')->name('save.bookmark');
            //Delete
            Route::delete('{id}/delete', 'BookmarksController@destroy')->name('delete.bookmark');
        });

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
        Route::prefix('fansub')->group(function () {
            Route::get('{id}.{slug}', 'FansubsController@show')->name('fansub.show');
            Route::get('{id}/edit', 'FansubsController@edit');
            Route::put('{id}/edit', 'FansubsController@update');
            Route::get('{id}/members', 'FansubsController@members');
            Route::post('{fansub_id}/addmembers', 'FansubsController@addMembers')->name('site.fansub.addmember');
            Route::delete('{member_id}/delmembers', 'FansubsController@delMembers');
        });

        //Faqs
        Route::get('faq', 'FaqsController@index')->name('site.faq');

        //Forum
        Route::prefix('forum')->group(function () {
            //Forum main page
            Route::get('/', 'ForumsController@index')->name('forum');

            //Topics
            Route::get('{id}.{slug}', 'ForumsController@topics')->name('forum.topics');

            //Topic
            Route::get('topic/{id}.{slug}', 'ForumsController@topic')->name('forum.topic');

            //New topic
            Route::get('{id}.{slug}/new-topic', 'ForumsController@newTopicForm')->name('new.topic');
            Route::post('{id}.{slug}/new-topic', 'ForumsController@newTopicPost')->name('post.topic');

            //Edit Post
            Route::get('topic/{id}.{slug}/post-{postId}/edit', 'ForumsController@postEditForm')->name('post.edit.form');
            Route::put('post/{postId}/edit', 'ForumsController@postEdit')->name('post.edit');

            //Delete Post
            Route::delete('post/{postId}', 'ForumsController@postDelete')->name('post.delete');

            //Delete Topic
            Route::delete('topic/{id}.{slug}', 'ForumsController@topicDelete')->name('topic.delete');

            //Reply
            Route::post('topic/{id}.{slug}/reply', 'ForumsController@reply')->name('forum.reply');

            // Open/Close Topic
            Route::get('topic/{id}.{slug}/openclose', 'ForumsController@openCloseTopic')->name('forum_openclose_topic');

            // Pin/Unpin Topic
            Route::get('topic/{id}.{slug}/pinunpin', 'ForumsController@pinUnpinTopic')->name('forum_pinunpin_topic');

            // Like - Dislike
            Route::get('like/post/{postId}', 'LikesController@likePost')->name('like.post');
            Route::get('dislike/post/{postId}', 'LikesController@dislikePost')->name('dislike.post');

            //Search
            Route::get('search', 'ForumsController@search')->name('forum.search');

            //Other
            Route::get('subscriptions', 'ForumsController@subscriptions')->name('forum_subscriptions');
            Route::get('latest/topics', 'ForumsController@latestTopics')->name('forum_latest_topics');
            Route::get('latest/posts', 'ForumsController@latestPosts')->name('forum_latest_posts');

            // Subscription
            Route::get('subscribe/topic/{route}.{topic}', 'SubscriptionsController@subscribeTopic')->name('subscribe_topic');
            Route::get('unsubscribe/topic/{route}.{topic}', 'SubscriptionsController@unsubscribeTopic')->name('unsubscribe_topic');

            //Poll Add TODO
//        Route::get('topico/{id}.{slug}/add-poll', 'ForumsController@topicAddPoll')->name('topic.add.poll');
//        Route::post('topico/{id}.{slug}/add-poll', 'ForumsController@topicSavePoll')->name('topic.save.poll');
        });

        //Freeslots
        Route::resource('freeslots', 'FreeSlotsController')->only(['index', 'store']);

        //Home
        Route::get('home', 'HomeController@index')->name('home');

        //Invites
        Route::resource('invites', 'InvitationsController')->only(['index', 'store']);
        Route::get('resendinvite/{id}', 'InvitationsController@resend')->name('invite.resend');

        //Lotteries TODO
        //Route::get('lotteries', 'LotteriesController@index')->name('site.lotteries');

        //Media
        Route::prefix('media')->group(function () {
            Route::get('{id}.{slug}', 'MediasController@show')->name('media.show');
            //Votar na Media
            Route::post('{id}/vote', 'MediasController@vote')->name('media.vote');
        });

        //News
        Route::get('news/{id}.{slug}', 'NewsController@show')->name('read.news');

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

        //Rules
        Route::get('rules', 'RulesController@index')->name('site.rules');

        //Statistics
        Route::prefix('statistics')->group(function () {
            Route::get('/', 'StatisticsController@index')->name('statistics');
            Route::get('user/uploaded', 'StatisticsController@uploaded')->name('stats.uploaded');
            Route::get('user/downloaded', 'StatisticsController@downloaded')->name('stats.downloaded');
            Route::get('user/seeders', 'StatisticsController@seeders')->name('stats.seeders');
            Route::get('user/leechers', 'StatisticsController@leechers')->name('stats.leechers');
            Route::get('user/uploaders', 'StatisticsController@uploaders')->name('stats.uploaders');
            Route::get('user/points', 'StatisticsController@points')->name('stats.points');
            Route::get('user/levels', 'StatisticsController@levels')->name('stats.levels');
            Route::get('user/seedtime', 'StatisticsController@seedtime')->name('stats.seedtime');

            Route::get('torrent/seeded', 'StatisticsController@seeded')->name('stats.seeded');
            Route::get('torrent/leeched', 'StatisticsController@leeched')->name('stats.leeched');
            Route::get('torrent/completed', 'StatisticsController@completed')->name('stats.completed');
            Route::get('torrent/dying', 'StatisticsController@dying')->name('stats.dying');
            Route::get('torrent/dead', 'StatisticsController@dead')->name('stats.dead');

            Route::get('groups', 'StatisticsController@groups')->name('stats.groups');
            Route::get('group/{slug}', 'StatisticsController@group')->name('stats.group');

            Route::get('states', 'StatisticsController@states')->name('stats.states');
            Route::get('state/{state_id}', 'StatisticsController@state')->name('stats.state');
        });

        //Studios
        Route::get('studio/{id}.{slug}', 'StudiosController@show')->name('studio.show');

        //Torrents
        Route::resource('torrents', 'TorrentsController')->except(['show']);

        //Torrent Search
        Route::post('torrents/search', 'TorrentsController@search')->name('torrents.search');

        //Torrent Options
        Route::prefix('torrent')->group(function () {
            //Download file
            Route::get('{id}/download', 'TorrentsController@download')->name('torrent.download');
            //Page info
            Route::get('{id}.{slug}', 'TorrentsController@show')->name('torrent.show');
            //Thanks
            Route::post('{id}/thanks', 'TorrentsController@thanks')->name('torrent.thanks');
            //ReSeed
            Route::get('{id}/reseed', 'TorrentsController@reSeed')->name('torrent.reseed');
            //Uploads
            Route::get('uploads', 'TorrentsController@uploads')->name('torrent.uploads');
        });

        //Users
        Route::get('users', 'UsersController@index')->name('site.users');

        //User Options
        Route::prefix('user')->group(function () {
            Route::get('{slug}', 'UsersController@profile')->name('user.profile');
            Route::get('{slug}/friends', 'UsersController@friends')->name('user.friends');
            Route::get('{slug}/achievements', 'UsersController@achievements')->name('user.achievements');
            //Post Avatar/Cover image
            Route::post('edit/avatar', 'UsersController@postAvatar')->name('post.avatar');
            Route::post('edit/cover', 'UsersController@postCover')->name('post.cover');
            //Update/Edit Account
            Route::get('edit/account', 'UsersController@formAccount')->name('edit.profile');
            Route::post('edit/account', 'UsersController@postAccount')->name('post.profile');
            //Update/Edit Password
            Route::get('edit/password', 'UsersController@formPassword')->name('edit.password');
            Route::post('edit/password', 'UsersController@postPassword')->name('post.password');
            //Update/Edit Privacy
            Route::get('edit/privacy', 'UsersController@formPrivacy')->name('edit.privacy');
            Route::post('edit/privacy', 'UsersController@postPrivacy')->name('post.privacy');
            //Update/Edit Setting
            Route::get('edit/social', 'UsersController@formSocial')->name('edit.social');
            Route::post('edit/social', 'UsersController@postSocial')->name('post.social');
            //Update/Edit Passkey
            Route::get('edit/passkey', 'UsersController@formPasskey')->name('edit.passkey');
            Route::post('edit/passkey', 'UsersController@postPasskey')->name('post.passkey');
            //Update/Edit Email
            Route::get('edit/email', 'UsersController@formEmail')->name('edit.email');
            Route::post('edit/email', 'UsersController@postEmail')->name('post.email');
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
            Route::prefix('backups')->group(function () {
                Route::get('/', 'BackupsController@index')->name('staff.backups');
                Route::post('create-full', 'BackupsController@create');
                Route::post('create-files', 'BackupsController@createFilesOnly');
                Route::post('create-db', 'BackupsController@createDatabaseOnly');
                Route::get('download/{file_name?}', 'BackupsController@download');
                Route::post('delete', 'BackupsController@delete');
            });

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
            Route::prefix('commands')->group(function () {
                Route::get('/', 'CommandsController@index')->name('staff.commands');
                Route::get('maintance-enable', 'CommandsController@maintanceEnable');
                Route::get('maintance-disable', 'CommandsController@maintanceDisable');
                Route::get('clear-cache', 'CommandsController@clearCache');
                Route::get('clear-view-cache', 'CommandsController@clearView');
                Route::get('clear-route-cache', 'CommandsController@clearRoute');
                Route::get('clear-config-cache', 'CommandsController@clearConfig');
                Route::get('clear-all-cache', 'CommandsController@clearAllCache');
                Route::get('set-all-cache', 'CommandsController@setAllCache');
                Route::get('clear-compiled', 'CommandsController@clearCompiled');
                Route::get('test-email', 'CommandsController@testEmail');
            });

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
            Route::get('forum/{id}/moderators', 'ForumsController@formModerators');
            Route::post('forum/{id}/moderators', 'ForumsController@postModerators');

            //Genres
            Route::resource('genres', 'GenresController')->except(['create', 'show', 'edit']);

            //Groups
            Route::resource('groups', 'GroupsController')->except(['show']);

            //Icons
            Route::prefix('icons')->group(function () {
                Route::get('fontawesome', 'IconsController@fontawesome')->name('staff.icons.fontawesome');
                Route::get('ionicons', 'IconsController@ionicons')->name('staff.icons.ionicons');
                Route::get('linearicons', 'IconsController@linearicons')->name('staff.icons.linearicons');
                Route::get('openiconic', 'IconsController@openiconic')->name('staff.icons.open-iconic');
                Route::get('strokeicons', 'IconsController@strokeicons')->name('staff.icons.stroke-icons-7');
            });

            //Logs TODO
            //Route::get('logs', 'LogsController@index')->name('staff.logs');

            //Lotteries TODO
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
            Route::prefix('settings')->group(function () {
                Route::match(['get', 'post'], 'analytics', 'SettingsController@analytics')->name('setting.analytics');
                Route::match(['get', 'post'], 'favicon', 'SettingsController@favicon')->name('setting.favicon');
                Route::match(['get', 'post'], 'images', 'SettingsController@images')->name('setting.images');
                Route::match(['get', 'post'], 'mail', 'SettingsController@mail')->name('setting.mail');
                Route::match(['get', 'post'], 'others', 'SettingsController@others')->name('setting.others');
                Route::match(['get', 'post'], 'points', 'SettingsController@points')->name('setting.points');
                Route::match(['get', 'post'], 'policy', 'SettingsController@policy')->name('setting.policy');
                Route::match(['get', 'post'], 'seo', 'SettingsController@seo')->name('setting.seo');
                Route::match(['get', 'post'], 'social', 'SettingsController@social')->name('setting.social');
            });

            //Studios
            Route::resource('studios', 'StudiosController')->except(['show']);

            //Torrents
            Route::get('torrents', 'TorrentsController@index');
            Route::get('torrents/{torrent_id}/edit', 'TorrentsController@edit');
            Route::put('torrents/{torrent_id}', 'TorrentsController@update');
            Route::delete('torrents/{torrent_id}', 'TorrentsController@destroy');

            //Torrent Options
            Route::put('torrent/{id}/freeleech', 'TorrentsController@freeleech');
            Route::put('torrent/{id}/silver', 'TorrentsController@silver');
            Route::put('torrent/{id}/doubleup', 'TorrentsController@doubleup');

            //Traffics
            Route::prefix('traffics')->group(function () {
                Route::get('/', 'TrafficsController@index')->name('traffic.index'); //Index
                Route::get('hourly', 'TrafficsController@hourly')->name('traffic.hourly'); //Hourly
                Route::get('daily', 'TrafficsController@daily')->name('traffic.daily'); //Daily
                Route::get('monthly', 'TrafficsController@monthly')->name('traffic.monthly'); //Monthly
                Route::get('top10', 'TrafficsController@topten')->name('traffic.topten'); //Top10
            });

            //Users
            Route::resource('users', 'UsersController')->except(['create', 'store', 'show']);

            //User Options
            Route::prefix('user')->group(function () {
                //Ban user
                Route::get('{id}/ban', 'UsersController@formBan');
                Route::post('banning', 'UsersController@postBan');
                //Suspend user
                Route::get('{id}/suspend', 'UsersController@formSuspend');
                Route::post('suspend', 'UsersController@postSuspend');
                //Warn user
                Route::get('{id}/warn', 'UsersController@formWarn');
                Route::post('warning', 'UsersController@postWarn');
                //Notes user
                Route::get('{id}/notes', 'UsersController@formNote')->name('staff.user.notes');
                Route::post('notes', 'UsersController@postNote');
                //Search user
                Route::post('search', 'UsersController@search');
                //Permissions
                Route::get('{id}/permissions', 'UsersController@formPermission')->name('staff.user.permissions');
                Route::post('{id}/updatepermission', 'UsersController@updatePermission');
            });

            //Visitors
            Route::get('visitors', 'VisitorsController@index')->name('staff.visitors');
        });
    });
});
