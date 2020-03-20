<?php

    Route::group(['prefix' => 'admin/modules/portfolio', 'as' => 'admin.modules.portfolio.', 'middleware' => 'access:ADMIN_VIEW'], function () {
        Route::get('/', 'PortfolioController@index')->name('index');
        Route::get('/create', 'PortfolioController@create')->name('create');
        Route::post('/', 'PortfolioController@store')->name('store');
        Route::get('/{id}', 'PortfolioController@edit')->name('edit');
        Route::get('/{id}/delete', 'PortfolioController@delete')->name('delete');
        Route::patch('/{id}', 'PortfolioController@update')->name('update');
        Route::post('/fileupload','PortfolioController@fileupload')->name('fileupload');
    });
