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
