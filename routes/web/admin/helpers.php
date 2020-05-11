<?php

use App\Helpers\ThemeHelpers;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return redirect(route('admin.dashboard.index'));
});

Auth::routes();
Route::get('/locale', LocaleController::class)->name('locale');


Route::get('theme/assets/{type}/{filename}', function ($type, $filename) {
    $path = base_path() . '/resources/views/themes/' . ThemeHelpers::activeTheme() . '/assets/' . $type . "/" . $filename;

    $file = File::get($path);

    switch ($type) {
        case "css":
            $type = "text/css";
            break;

        default:
            $type = File::mimeType($path);
            break;
    }

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
