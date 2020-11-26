<?php

// OPEN ROUTES

// Route::get('/v1/posts/categories/', 'api\PostCategoriesController@index');
// Route::get('/v1/posts/category/{id}/', 'api\PostCategoriesController@show');

// Route::get('/v1/category/{category}/posts/', 'api\PostCategoriesController@posts');
// Route::get('/v1/posts/category/{category}/entries/', 'api\PostCategoriesController@posts');

Route::group(['middleware' => ['jwt.verify']], function () {
    // Route::post('/v1/posts/category/', 'api\PostCategoriesController@store');
    // Route::delete('/v1/posts/category/{id}/', 'api\PostCategoriesController@destroy');
    // Route::patch('/v1/posts/category/{id}/', 'api\PostCategoriesController@update');
});
