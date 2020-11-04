<?php

Route::get('/user/profile/edit', 'Front\UsersController@edit')->name('user.edit');
Route::patch('/user/profile', 'Front\UsersController@update')->name('user.update');
