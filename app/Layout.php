<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function blocks()
    {
        return $this->hasMany(\App\Block::class);
    }
}
