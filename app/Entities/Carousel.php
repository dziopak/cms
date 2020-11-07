<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url');
    }
}
