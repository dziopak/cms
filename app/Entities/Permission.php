<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false, $increment = false;
    protected $fillable = ['name', 'role_id'];
}
