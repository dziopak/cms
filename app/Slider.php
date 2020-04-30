<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;

class Slider extends Model
{
    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
