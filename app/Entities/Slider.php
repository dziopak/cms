<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\File;

class Slider extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
