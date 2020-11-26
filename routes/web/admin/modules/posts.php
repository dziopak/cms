<?php
Route::resource('/posts', 'Admin\Modules\PostsController')->except('show');
Route::get('/posts/{post_id}/delete', 'Admin\Modules\PostsController@delete')->name('posts.delete');
Route::post('/posts/mass', 'Admin\Modules\PostsController@mass')->name('posts.mass');
