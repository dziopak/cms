<?php
// OPEN ROUTES
Route::get('/v1/posts', 'api\PostsController@index');
Route::get('/v1/post/{id}', 'api\PostsController@show');

// AUTH ROUTES
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/v1/post', 'api\PostsController@store')->name('api.posts.store.single');
    Route::post('/v1/posts', 'api\PostsController@store')->name('api.posts.store.many');

    Route::delete('/v1/post/{id}', 'api\PostsController@destroy')->name('api.posts.delete.single');
    Route::delete('/v1/posts', 'api\PostsController@destroy')->name('api.posts.delete.many');

    Route::patch('/v1/post/{id}', 'api\PostsController@update')->name('api.posts.update.single');
    Route::patch('/v1/posts', 'api\PostsController@update')->name('api.posts.update.many');
});
