<?php
Route::resource('/media', 'Admin\Modules\Files\FilesController', ['parameters' => [
    'media' => 'file'
]]);
Route::post('/media/upload', 'Admin\Modules\Files\FilesController@store')->name('media.upload');
Route::post('/media/mass', 'Admin\Modules\Files\FilesController@mass')->name('media.mass');
