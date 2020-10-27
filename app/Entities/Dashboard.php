<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'widgets'];
}
