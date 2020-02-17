<?php
    Route::resource('/pages', 'AdminPagesController')->except('show');
    Route::get('/pages/{page_id}/delete', 'AdminPagesController@delete')->name('pages.delete');
    
    //Categories routes//
    // Route::group(['prefix' => 'pages', 'as' => 'pages.'], function ()  {
    //     Route::resource('/categories', 'AdminPageCategoriesController');
    //     Route::get('/categories/{category_id}/delete', 'AdminPageCategoriesController@delete')->name('categories.delete');
    // });
?>