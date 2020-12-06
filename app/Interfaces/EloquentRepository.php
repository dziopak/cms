<?php

namespace App\Interfaces;

interface EloquentRepository
{

    public function store($attributes);
    public function update($attributes);
    public function destroy($attributes);

    public function find($id);
}
