<?php

use App\Http\Utilities\Admin\PluginUtilities;

PluginUtilities::registerRoutes('portfolio');

Route::group(['prefix' => 'admin/plugins/portfolio/categories/', 'as' => 'admin.plugins.portfolio.categories.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::get('/', 'PortfolioCategoriesController@index')->name('index');
    Route::post('/', 'PortfolioCategoriesController@store')->name('store');
    Route::patch('/{id}', 'PortfolioCategoriesController@update')->name('update');
    Route::get('/create', 'PortfolioCategoriesController@create')->name('create');
    Route::get('/{id}', 'PortfolioCategoriesController@edit')->name('edit');
});

Route::group(['prefix' => 'admin/plugins/portfolio', 'as' => 'admin.plugins.portfolio.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::get('/create', 'PortfolioController@create')->name('create');
    Route::post('/', 'PortfolioController@store')->name('store');
    Route::get('/{id}', 'PortfolioController@edit')->name('edit');
    Route::get('/{id}/delete', 'PortfolioController@delete')->name('delete');
    Route::patch('/{id}', 'PortfolioController@update')->name('update');
    Route::put('/{id}', 'PortfolioController@update')->name('update');
    Route::post('/{id}/attach', 'PortfolioController@attach')->name('attach');
    Route::post('/{id}/detach', 'PortfolioController@detach')->name('detach');
    Route::post('/{id}/category/attach', 'PortfolioItemCategoriesController@attach')->name('category.attach');
    Route::post('/{id}/category/detach', 'PortfolioItemCategoriesController@detach')->name('category.detach');
    Route::post('/{id}/content/attach', 'PortfolioContentBoxesController@attach')->name('content.attach');
    Route::post('/{id}/content/detach', 'PortfolioContentBoxesController@detach')->name('content.detach');
});
