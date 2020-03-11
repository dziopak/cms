<?php

    // OPEN ROUTES
    
    Route::get('/posts/categories/', 'api\PostCategoriesController@index');
    Route::get('/posts/category/{id}/', 'api\PostCategoriesController@show');
    
    Route::get('/category/{category}/posts/', 'api\PostCategoriesController@posts');
    Route::get('/posts/category/{category}/entries/', 'api\PostCategoriesController@posts');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/posts/category/', 'api\PostCategoriesController@store');
        Route::delete('/posts/category/{id}/', 'api\PostCategoriesController@destroy');
        Route::patch('/posts/category/{id}/', 'api\PostCategoriesController@update');
    });
?>