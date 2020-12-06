<?php

Route::get('/plugins', 'Admin\Modules\Plugins\PluginsController@index')->name('plugins.index');
Route::get('/plugins/{slug}/disable', 'Admin\Modules\Plugins\PluginsController@disable')->name('plugins.disable');
Route::get('/plugins/{slug}/enable', 'Admin\Modules\Plugins\PluginsController@enable')->name('plugins.enable');
