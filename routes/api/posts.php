<?php
    // OPEN ROUTES
    Route::get('/posts', 'api\PostsController@index');
    Route::get('/post/{id}', 'api\PostsController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/post', 'api\PostsController@store');
        Route::delete('/post/{id}', 'api\PostsController@destroy');
        Route::patch('/post/{id}', 'api\PostsController@update');
    });
?>