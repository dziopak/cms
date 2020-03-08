<?php

    // OPEN ROUTES
    
    Route::get('/posts/categories/', 'api\PostCategoriesController@index');
    Route::get('/posts/category/{id}/', 'api\PostCategoriesController@show');
    Route::get('/posts/category/', 'api\PostCategoriesController@find');
    
    Route::get('/category/{category}/posts/', 'api\PostCategoriesController@posts');
    Route::get('/posts/category/{category}/entries/', 'api\PostCategoriesController@posts');
?>