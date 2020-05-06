<?php

Route::resource('/sliders', 'Admin\Blocks\SlidersController')->except('show');
Route::post('/sliders/{slider}/attach', 'Admin\Blocks\SlidersController@attach')->name('sliders.attach');
Route::post('/sliders/{slider}/detach', 'Admin\Blocks\SlidersController@detach')->name('sliders.detach');
