<?php

Route::get('/user/profile/edit', 'Front\UsersController@edit')->name('user.edit')->middleware(['verified', 'password.confirm']);
Route::patch('/user/profile', 'Front\UsersController@update')->name('user.update')->middleware(['verified', 'password.confirm']);
Route::get('/user/profile/social', 'Front\SocialProfileController@index')->name('user.social');
Route::post('/user/profile/social', 'Front\SocialProfileController@update')->name('user.social.update');
