<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ApiEntity
{
    static function store($request);
    public function show();
    public function update(Request $request);
    public function destroy();
}
