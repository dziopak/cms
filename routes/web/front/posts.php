<?php

Route::get('/posts/{id}/', 'Front\PostsController@show')->name('posts.show');
Route::get('/category/{category}/posts', 'Front\PostCategoriesController@show')->name('posts.categories.show');
