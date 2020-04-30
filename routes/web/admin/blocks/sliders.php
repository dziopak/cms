<?php
Route::resource('/blocks/sliders', 'Admin\Blocks\SlidersController')->except('show');
Route::get('/blocks/sliders/{slider}/delete', 'Admin\Blocks\SlidersController@delete')->name('sliders.delete');
Route::post('/blocks/sliders/{slider}/attach', 'Admin\Blocks\SlidersController@attach')->name('sliders.attach');
