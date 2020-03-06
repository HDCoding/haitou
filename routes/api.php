<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(function () {
    //Calendars
    Route::get('calendars', 'CalendarsController@index');
    //Chat Rooms
    Route::get('chatrooms', 'ChatController@rooms');
    Route::post('change-chatroom', 'ChatController@changeChatroom');
    Route::get('messages', 'ChatController@messages');
    Route::post('messages', 'ChatController@sendMessage');
});
