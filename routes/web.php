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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::get('garbage/notificationCreate', 'Admin\GarbageController@add');
    Route::post('garbage/notificationCreate', 'Admin\GarbageController@notificationCreate');
    Route::get('garbage', 'Admin\GarbageController@notificationIndex');
    Route::get('garbage/notificationEdit', 'Admin\GarbageController@notificationEdit');
    Route::post('garbage/notificationEdit', 'Admin\GarbageController@update');
    Route::get('garbage/notificationDelete', 'Admin\GarbageController@notificationDelete');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

