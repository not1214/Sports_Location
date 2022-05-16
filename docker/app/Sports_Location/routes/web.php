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
Route::get('/', 'App\Http\Controllers\HomeController@top');
Route::get('events', 'App\Http\Controllers\EventController@index')->name('events.index');

Route::get('/contact', 'App\Http\Controllers\ContactController@form')->name('contact.form');
Route::post('/contact/confirm', 'App\Http\Controllers\ContactController@confirm')->name('contact.confirm');
Route::post('/contact/send', 'App\Http\Controllers\ContactController@send')->name('contact.send');
Route::get('/contact/complete', 'App\Http\Controllers\ContactController@complete')->name('contact.complete');

//Admin認証不要
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login']);
});

// Adminログイン認証
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    Route::post('logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout');
    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    Route::resource('events', 'App\Http\Controllers\Admin\EventController', ['except' => ['create', 'store', 'destroy']]);
    Route::post('events/{event}/edit/confirm', [\App\Http\Controllers\Admin\EventController::class, 'confirm'])->name('events.confirm');

    Route::get('users', 'App\Http\Controllers\Admin\UserController@index')->name('user.index');
    Route::get('users/{username}', 'App\Http\Controllers\Admin\UserController@show')->name('user.show');
    Route::get('users/{username}/edit', 'App\Http\Controllers\Admin\UserController@edit')->name('user.edit');
    Route::put('users/{username}', 'App\Http\Controllers\Admin\UserController@update')->name('user.update');
    Route::get('users/{username}/events', 'App\Http\Controllers\Admin\UserController@createdEvents')->name('user.createdEvents');
    Route::get('users/{username}/pastEvents', 'App\Http\Controllers\Admin\UserController@pastEvents')->name('user.pastEvents');
    Route::get('users/{username}/followings', 'App\Http\Controllers\Admin\UserController@followings')->name('user.followings');
    Route::get('users/{username}/followers', 'App\Http\Controllers\Admin\UserController@followers')->name('user.followers');
    Route::get('users/{username}/unsubscribe', 'App\Http\Controllers\Admin\UserController@unsubscribe')->name('user.unsubscribe');
    Route::post('users/{username}/withdraw', 'App\Http\Controllers\Admin\UserController@withdraw')->name('user.withdraw');

    Route::get('events/area/{area_id}', 'App\Http\Controllers\Admin\AreaController@show')->name('area.show');
    Route::resource('genres', 'App\Http\Controllers\Admin\GenreController', ['only' => ['index', 'store', 'edit', 'update']]);
    Route::get('events/genre/{genre_id}', 'App\Http\Controllers\Admin\GenreController@show')->name('genre.show');
});

// Userログイン認証
Route::group(['middleware' => ['auth']], function () {
    Route::resource('events', 'App\Http\Controllers\EventController', ['except' => ['index']]);
    Route::post('events/create/confirm', [\App\Http\Controllers\EventController::class, 'createConfirm'])->name('events.create_confirm');
    Route::post('events/{event}/edit/confirm', [\App\Http\Controllers\EventController::class, 'editConfirm'])->name('events.edit_confirm');
    Route::get('events/{event}/favorite', 'App\Http\Controllers\EventController@favorite')->name('event.favorite');
    Route::get('events/{event}/unfavorite', 'App\Http\Controllers\EventController@unfavorite')->name('event.unfavorite');

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

    Route::resource('events.reservations', 'App\Http\Controllers\ReservationController');

    Route::get('events/genre/{genre_id}', 'App\Http\Controllers\GenreController@show')->name('genre.show');
    Route::get('events/area/{area_id}', 'App\Http\Controllers\AreaController@show')->name('area.show');
});
