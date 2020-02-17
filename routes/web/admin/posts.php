<?php
    Route::resource('/posts', 'AdminPostsController')->except('show');
    Route::get('/posts/{post_id}/delete', 'AdminPostsController@delete')->name('posts.delete');
    
    //Categories routes//
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function ()  {
        Route::resource('/categories', 'AdminPostCategoriesController');
        Route::get('/categories/{category_id}/delete', 'AdminPostCategoriesController@delete')->name('categories.delete');
    });
?>