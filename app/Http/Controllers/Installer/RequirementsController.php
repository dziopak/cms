<?php

namespace App\Http\Controllers\Installer;

use RachidLaasri\LaravelInstaller\Controllers\RequirementsController as ParentController;

class RequirementsController extends ParentController
{

    public function setup()
    {
        $request = request();
        if (!empty($lang = $request->get('language'))) {
            setLang($lang);
        }
        return redirect(route('LaravelInstaller::requirements'));
    }
}
