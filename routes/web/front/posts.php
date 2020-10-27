<?php

Route::get('/', 'Front\PostsController@index')->name('posts.index');
Route::get('/posts/{id}/', 'Front\PostsController@show')->name('posts.show');
