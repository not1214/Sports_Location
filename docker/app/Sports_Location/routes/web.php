<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// User認証不要
Route::get('/', function () {
    return view('top');
});

Route::get('events', 'App\Http\Controllers\EventController@index')->name('events.index');

// Userログイン後
Route::group(['middleware' => ['auth']], function () {
    Route::resource('events', 'App\Http\Controllers\EventController', ['except' => ['index']]);
    Route::post('events/create/confirm', [\App\Http\Controllers\EventController::class, 'createConfirm'])->name('events.create_confirm');
    Route::post('events/{event}/edit/confirm', [\App\Http\Controllers\EventController::class, 'editConfirm'])->name('events.edit_confirm');
    Route::get('events/{event}/favorite', 'App\Http\Controllers\EventController@favorite')->name('event.favorite');
    Route::get('event/{event}/unfavorite', 'App\Http\Controllers\EventController@unfavorite')->name('event.unfavorite');

    Route::get('myPage', 'App\Http\Controllers\UserController@myPage')->name('user.myPage');
    Route::get('myPage/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit');
    Route::put('myPage', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::get('myPage/unsubscribe', 'App\Http\Controllers\UserController@unsubscribe')->name('user.unsubscribe');
    Route::post('myPage/withdraw', 'App\Http\Controllers\UserController@withdraw')->name('user.withdraw');
    Route::get('myPage/events', 'App\Http\Controllers\UserController@createdEvents')->name('user.createdEvents');
    Route::get('myPage/pastEvents', 'App\Http\Controllers\UserController@pastEvents')->name('user.pastEvents');
    Route::get('myPage/reservations', 'App\Http\Controllers\UserController@reservedEvents')->name('user.reservedEvents');
    Route::get('myPage/favorites', 'App\Http\Controllers\UserController@favoriteEvents')->name('user.favoriteEvents');
    Route::get('myPage/followings', 'App\Http\Controllers\UserController@myFollowings')->name('user.my_followings');
    Route::get('myPage/followers', 'App\Http\Controllers\UserController@myFollowers')->name('user.my_followers');
    Route::get('{username}', 'App\Http\Controllers\UserController@show')->name('user.show');
    Route::get('{username}/events', 'App\Http\Controllers\UserController@events')->name('user.events');
    Route::get('{username}/follow', 'App\Http\Controllers\UserController@follow')->name('user.follow');
    Route::get('{username}/unFollow', 'App\Http\Controllers\UserController@unFollow')->name('user.unFollow');
    Route::get('{username}/followings', 'App\Http\Controllers\UserController@followings')->name('user.followings');
    Route::get('{username}/followers', 'App\Http\Controllers\UserController@followers')->name('user.followers');
});

//Admin認証不要
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/home');
    });
    Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login']);
});

// Adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
});
