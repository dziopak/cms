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

Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

//Backoffice routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    
    Route::get('/', function() {
        return view('admin.dashboard.index');
    })->name('dashboard.index');
    
    //Users routes
    Route::resource('/users', 'AdminUsersController', ['user' => 'user']);
    Route::get('/{user_id}/delete', 'AdminUsersController@delete')->name('users.delete');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
