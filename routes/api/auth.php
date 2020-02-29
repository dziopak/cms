<?php
    // OPEN ROUTES //
    Route::post('/register', 'api\UsersController@register');
    Route::post('/login', 'api\UsersController@authenticate');

    // AUTH ROUTES //
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('/user', 'api\UsersController@getAuthenticatedUser');
    });
?>