<?php

Route::get('/plugins', 'Admin\Modules\PluginsController@index')->name('plugins.index');
Route::get('/plugins/{slug}/disable', 'Admin\Modules\PluginsController@disable')->name('plugins.disable');
Route::get('/plugins/{slug}/enable', 'Admin\Modules\PluginsController@enable')->name('plugins.enable');
