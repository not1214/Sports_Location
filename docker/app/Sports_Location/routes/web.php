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


Route::group(['middleware' => 'auth'], function () {
    Route::get('mypage', 'App\Http\Controllers\UserController@mypage')->name('user.mypage');
    Route::get('mypage/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit');
    Route::post('mypage', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::get('mypage/unsubscribe', 'App\Http\Controllers\UserController@unsubscribe')->name('user.unsubscribe');
    Route::destroy('mypage/withdraw', 'App\Http\Controllers\UserController@withdraw')->name('user.withdraw');
    Route::get('mypage/events', 'App\Http\Controllers\UserController@created_events')->name('user.created_events');
    Route::get('mypage/reservations', 'App\Http\Controllers\UserController@reserved_events')->name('user.reserved_events');
    Route::get('mypage/favorites', 'App\Http\Controllers\UserController@favorited_events')->name('user.favorited_events');
    Route::get('mypage/followings', 'App\Http\Controllers\UsersController@my_followings')->name('user.my_followings');
    Route::get('mypage/followers', 'App\Http\Controllers\UsersController@my_followers')->name('user.my_followers');
    Route::get('{username}', 'App\Http\Controllers\UserController@show')->name('user.show');
    Route::get('{username}/events', 'App\Http\Controllers\UserController@events')->name('user.events');
    Route::get('{username}/followings', 'App\Http\Controllers\UserController@followings')->name('user.followings');
    Route::get('{username}/followers', 'App\Http\Controllers\UserController@followers')->name('user.followers');
});
