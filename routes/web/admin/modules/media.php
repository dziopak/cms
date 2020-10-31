<?php
Route::resource('/media', 'Admin\Modules\FilesController', ['parameters' => [
    'media' => 'file'
]]);
Route::post('/media/upload', 'Admin\Modules\FilesController@upload')->name('media.upload');
Route::post('/media/mass', 'Admin\Modules\FilesController@mass')->name('media.mass');
