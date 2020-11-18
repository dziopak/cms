<?php

namespace App\Interfaces;

interface WebEntity
{
    static function index($request);
    static function create();
    static function store($request);
    public function edit();
    public function update($request);
    public function destroy();
}
