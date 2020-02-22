<?php
    Route::resource('/posts', 'admin\PostsController')->except('show');
    Route::get('/posts/{post_id}/delete', 'admin\PostsController@delete')->name('posts.delete');
    Route::post('/posts/mass', 'admin\PostsController@mass')->name('posts.mass');
    
    //Categories routes//
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function ()  {
        Route::resource('/categories', 'admin\PostCategoriesController');
        Route::get('/categories/{category_id}/delete', 'admin\PostCategoriesController@delete')->name('categories.delete');
        Route::post('/posts/categories/mass', 'admin\PostCategoriesController@mass')->name('categories.mass');
    });
?>