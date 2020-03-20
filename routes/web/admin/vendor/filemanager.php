<?php
    //FILE MANAGER ROUTES
    Route::get('/files', function() {
        return view('admin.filemanager');
    })->name('filemanager');
    
    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
?>