<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Slider extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
