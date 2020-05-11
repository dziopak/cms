<?php

Route::resource('/media', 'Admin\Modules\FilesController')->except('show');
Route::post('/media/upload', 'Admin\Modules\FilesController@upload')->name('media.upload');
