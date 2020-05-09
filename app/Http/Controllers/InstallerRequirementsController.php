<?php

namespace App\Http\Controllers;

use RachidLaasri\LaravelInstaller\Controllers\RequirementsController;

class InstallerRequirementsController extends RequirementsController
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
