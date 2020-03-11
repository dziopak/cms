<?php
    // OPEN ROUTES
    Route::get('/users', 'api\UsersController@index');
    Route::get('/user/{id}', 'api\UsersController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/user', 'api\UsersController@store');
        Route::delete('/user/{id}', 'api\UsersController@destroy');
        Route::patch('/user/{id}', 'api\UsersController@update');
    });
?>