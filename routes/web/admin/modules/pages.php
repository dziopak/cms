<?php
Route::resource('/pages', 'Admin\Modules\Pages\PagesController')->except('show');
Route::get('/pages/{page}/delete', 'Admin\Modules\Pages\PagesController@delete')->name('pages.delete');
Route::post('/pages/mass', 'Admin\Modules\Pages\PagesController@mass')->name('pages.mass');
Route::post('/pages/{page}/thumbnail', 'Admin\Modules\Pages\PagesController@thumbnail')->name('pages.thumbnail');
