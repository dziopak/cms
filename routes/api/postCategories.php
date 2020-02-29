<?php
    // OPEN ROUTES
    Route::get('/postcategories', 'api\PostCategoriesController@index');
    Route::get('/postcategories/{id}', 'api\PostCategoriesController@show');
    Route::get('/post', 'api\PostCategoriesController@find');
    Route::get('/postcategories/{slug}', 'api\PostCategoriesController@show');

    // // AUTH ROUTES
    // Route::group(['middleware' => ['jwt.verify']], function() {
    //     Route::post('/post', 'api\PostsController@store');
    //     Route::delete('/post/{id}', 'api\PostsController@destroy');
    //     Route::patch('/post/{id}', 'api\PostsController@update');
    // });
?>