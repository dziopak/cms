<?php

    Route::group(['prefix' => 'admin/modules/portfolio', 'as' => 'admin.modules.portfolio.', 'middleware' => 'access:ADMIN_VIEW'], function () {
        Route::get('/', 'PortfolioController@index')->name('index');
    });
