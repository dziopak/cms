<?php

Route::resource('/media', 'Admin\FilesController')->except('show');
Route::get('/media/{id}/delete', 'Admin\FilesController@delete')->name('media.delete');
Route::post('/media/upload', 'Admin\FilesController@upload')->name('media.upload');
