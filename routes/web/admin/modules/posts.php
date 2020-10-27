<?php
Route::resource('/posts', 'Admin\Modules\PostsController')->except('show');
Route::get('/posts/{post_id}/delete', 'Admin\Modules\PostsController@delete')->name('posts.delete');
Route::post('/posts/mass', 'Admin\Modules\PostsController@mass')->name('posts.mass');

//Categories routes//
Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
    Route::resource('/categories', 'Admin\Modules\PostCategoriesController');
    Route::get('/categories/{category_id}/delete', 'Admin\Modules\PostCategoriesController@delete')->name('categories.delete');
    Route::post('/posts/categories/mass', 'Admin\Modules\PostCategoriesController@mass')->name('categories.mass');
});
