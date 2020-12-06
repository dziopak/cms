<?php
Route::resource('/posts', 'Admin\Modules\Posts\PostsController')->except('show');
Route::get('/posts/{post_id}/delete', 'Admin\Modules\Posts\PostsController@delete')->name('posts.delete');
Route::post('/posts/mass', 'Admin\Modules\Posts\PostsController@mass')->name('posts.mass');
