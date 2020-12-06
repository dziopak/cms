<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ApiEntities
{
    static function index($request);
    static function store($request);
    public function update(Request $request);
    public function destroy();
}
