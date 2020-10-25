<?php

// OPEN ROUTES
Route::get('/v1/users', 'api\UsersController@index');
Route::get('/v1/user/{id}', 'api\UsersController@show');

// AUTH ROUTES
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/v1/user', 'api\UsersController@store');
    Route::delete('/v1/user/{id}', 'api\UsersController@destroy');
    Route::patch('/v1/user/{id}', 'api\UsersController@update');
});
