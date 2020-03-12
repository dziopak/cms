<?php
    // OPEN ROUTES
    
    Route::get('/pages/categories/', 'api\PageCategoriesController@index');
    Route::get('/pages/category/{id}/', 'api\PageCategoriesController@show');
    
    Route::get('/category/{category}/pages/', 'api\PageCategoriesController@pages');
    Route::get('/pages/category/{category}/entries/', 'api\PageCategoriesController@pages');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/pages/category/', 'api\PageCategoriesController@store');
        Route::delete('/pages/category/{id}/', 'api\PageCategoriesController@destroy');
        Route::patch('/pages/category/{id}/', 'api\PageCategoriesController@update');
    });
?>