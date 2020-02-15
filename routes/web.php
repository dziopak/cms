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
    
    ////////////////
    //Users routes//
    ////////////////
    Route::resource('/users', 'AdminUsersController')->except('show');
    Route::get('/{user_id}/delete', 'AdminUsersController@delete')->name('users.delete');
    Route::get('/{user_id}/disable', 'AdminUsersController@disable')->name('users.disable');
    Route::put('/{user_id}/block', 'AdminUsersController@block')->name('users.block');
    //End of Users routes


    ////////////////
    //Roles routes//
    ////////////////
    Route::resource('/users/roles', 'RolesController')->except('show');
    Route::get('/users/roles/{role_id}/delete', 'RolesController@delete')->name('roles.delete');
    Route::get('/users/roles/{role_id}/duplicate', 'RolesController@duplicate')->name('roles.duplicate');
    //End of Roles routes
    
    ////////////////
    //Posts routes//
    ////////////////
    Route::resource('/posts', 'AdminPostsController');
    //End of Posts routes

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function ()  {
        
        ///////////////
        //Logs routes//
        ///////////////
        Route::get('/logs', 'LogsController@index')->name('logs.index');
        //End of Logs routes

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
