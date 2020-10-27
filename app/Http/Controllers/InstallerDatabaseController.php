<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RachidLaasri\LaravelInstaller\Controllers\DatabaseController;

class InstallerDatabaseController extends DatabaseController
{
    public function db($locale = 'en')
    {
        setLang($locale);
        return parent::database();
    }
}
