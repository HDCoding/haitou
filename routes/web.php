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
Route::any('/', 'AppController@index');

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
