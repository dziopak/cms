<?php

namespace App\Http\Controllers;

use WebPConvert\WebPConvert;
use App\Http\Controllers\Controller;
use App\Jobs\OptimizeImages;
use Auth;

class WebpController extends Controller
{
    private $locations = [
        'images/uploads',
        'images/assets',
        'images/icons',
        'images/widgets'
    ];

    public function __invoke()
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');


        foreach ($this->locations as $location) {
            foreach (glob(public_path($location . '/*')) as $file) {
                //
                if (!file_exists($file . '.webp')) {
                    dispatch(new OptimizeImages($file));
                }
                //
            }
        }
        return redirect(route('admin.dashboard.index'))->with('crud', 'Image optimization has been finished successfully.');
    }
}
