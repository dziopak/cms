<?php

Route::get('/', 'Front\PostsController@index')->name('posts.index');
Route::get('/posts/{id}/', 'Front\PostsController@show')->name('posts.show');
Route::get('/category/{category}/pages', 'Front\PostCategoriesController@show')->name('posts.categories.show');
