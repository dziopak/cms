<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['title', 'config', 'type', 'x', 'y', 'layout_id', 'width', 'height', 'container'];
    public $timestamps = false;

    public function layouts()
    {
        return $this->belongsTo(\App\Entities\Layout::class);
    }
}
