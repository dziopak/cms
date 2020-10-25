<?php
    // OPEN ROUTES
    Route::get('/v1/posts', 'api\PostsController@index');
    Route::get('/v1/post/{id}', 'api\PostsController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/v1/post', 'api\PostsController@store');
        Route::delete('/v1/post/{id}', 'api\PostsController@destroy');
        Route::patch('/v1/post/{id}', 'api\PostsController@update');
    });
