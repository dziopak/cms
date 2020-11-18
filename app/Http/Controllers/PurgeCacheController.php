<?php

namespace App\Http\Controllers;

use Auth;
use Artisan;

class PurgeCacheController extends Controller
{
    public function __invoke()
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        Artisan::call('cache:clear');

        return redirect(route('admin.dashboard.index'))->with('crud', 'Cache successfully cleared.');
    }
}
