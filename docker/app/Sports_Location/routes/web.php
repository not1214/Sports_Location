<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('top');
});

Auth::routes();

// User認証不要
Route::get('/', function () {
    return redirect('/home');
});

// Userログイン後
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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

Route::resource('events', 'EventController');
