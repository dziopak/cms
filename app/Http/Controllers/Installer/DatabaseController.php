<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Http\Request;
use RachidLaasri\LaravelInstaller\Controllers\DatabaseController as ParentController;

class DatabaseController extends ParentController
{
    public function db($locale = 'en')
    {
        setLang($locale);
        return parent::database();
    }
}
