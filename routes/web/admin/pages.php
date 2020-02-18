<?php
    Route::resource('/pages', 'admin\PagesController')->except('show');
    Route::get('/pages/{page_id}/delete', 'admin\PagesController@delete')->name('pages.delete');
    
    // Categories routes//
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function ()  {
        Route::resource('/categories', 'admin\PageCategoriesController');
        Route::get('/categories/{category_id}/delete', 'admin\PageCategoriesController@delete')->name('categories.delete');
    });
?>