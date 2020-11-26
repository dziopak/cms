<?php

Route::get('/post/{id}/', 'Front\PostsController@show')->name('posts.show');
