<?php
    Route::resource('/pages', 'admin\PagesController')->except('show');
    Route::get('/pages/{page_id}/delete', 'admin\PagesController@delete')->name('pages.delete');
    Route::post('/pages/mass', 'admin\PagesController@mass')->name('pages.mass');
    
    // Categories routes//
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function ()  {
        Route::resource('/categories', 'admin\PageCategoriesController');
        Route::get('/categories/{category_id}/delete', 'admin\PageCategoriesController@delete')->name('categories.delete');
        Route::post('/pages/categories/mass', 'admin\PageCategoriesController@mass')->name('categories.mass');
    });
?>