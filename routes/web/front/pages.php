<?php

Route::get('/{id}', 'front\PagesController@show')->name('pages.index');
Route::get('/{id}', 'front\PagesController@show')->name('pages.show');
