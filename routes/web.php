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

use App\Http\Controllers\BoardsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route; //変更箇所



Route::group(['prefix' => 'board', 'middleware' => 'auth'], function () {
    Route::get('index', 'BoardsController@index')->name('board.index');
    Route::get('create', 'BoardsController@create')->name('board.create');
    Route::post('store', 'BoardsController@store')->name('board.store');
    Route::get('show/{id}', 'BoardsController@show')->name('board.show');
    Route::get('edit/{id}', 'BoardsController@edit')->name('board.edit');
    Route::post('update/{id}', 'BoardsController@update')->name('board.update');
    Route::post('destroy/{id}', 'BoardsController@destroy')->name('board.destroy');
    Route::get('logout', 'BoardsController@getLogout')->name('board.logout');
});

Route::group(['prefix' => 'comment', 'middleware' => 'auth'], function () {
    Route::post('store', "CommentsController@store")->name('comment.store');
    Route::post('destroy/{id}', 'CommentsController@destroy')->name('comment.destroy');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('index', 'UserController@index')->name('user.index');
    Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('update/{id}', 'UserController@update')->name('user.update');
});


Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        // Route::resource('board/index', 'BoardsController', ['only' => 'index']);


        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

/**
 * ゲストログインのルーティング
 */
Route::get('guest', 'User\Auth\LoginController@guestLogin')->name('login.guest');
