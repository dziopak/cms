<?php
Auth::routes(['verify' => true]);
Route::get('/login/{provider}', 'Auth\SocialLoginController@redirect');
Route::get('login/{provider}/callback', 'Auth\SocialLoginController@callback');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/locale', LocaleController::class)->name('locale');
Route::get('/module', 'Admin\PluginDownloadController@download');
Route::get('/offline', 'Front\OfflineController@index');
Route::get('/admin/settings/clear-cache', 'PurgeCacheController');
Route::get('/admin/optimize', 'WebpController');
Route::get('/theme/assets/{type}/{filename}', 'Front\AssetController');
