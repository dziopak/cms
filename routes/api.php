<?php

use Illuminate\Http\Request;

Route::get('/posts', 'api\PostsController@index');
Route::delete('/post/{id}', 'api\PostsController@destroy');
Route::patch('/post/{id}', 'api\PostsController@update');
Route::get('/post/{id}', 'api\PostsController@show');
Route::post('/post', 'api\PostsController@store');

// OPEN ROUTES //
Route::post('/register', 'api\UsersController@register');
Route::post('/login', 'api\UsersController@authenticate');


// AUTH ROUTES //
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/user', 'api\UsersController@getAuthenticatedUser');
});
