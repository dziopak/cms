<?php

Route::get('/', 'front\PostsController@index')->name('posts.index');
Route::get('/posts/{id}/', 'front\PostsController@show')->name('posts.show');
