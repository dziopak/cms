<?php
    // OPEN ROUTES //
    Route::post('/v1/register', 'api\UsersController@register');
    Route::post('/v1/login', 'api\UsersController@authenticate');

    // AUTH ROUTES //
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('/v1/user', 'api\UsersController@getAuthenticatedUser');
    });
