<?php

Route::resource('/carousels', 'Admin\Blocks\CarouselsController')->except('show');
Route::post('/carousels/{carousel}/attach', 'Admin\Blocks\CarouselsController@attach')->name('carousels.attach');
Route::post('/carousels/{carousel}/detach', 'Admin\Blocks\CarouselsController@detach')->name('carousels.detach');
Route::post('/carousels/mass/', 'Admin\Blocks\CarouselsController@mass')->name('carousels.mass');
