<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\File;
use App\Traits\Filterable;

class Slider extends Model
{
    use Filterable;

    public $timestamps = false, $cacheFor = 3600;
    protected $fillable = ['name'];
    protected static $flushCacheOnUpdate = true;
    private $searchIn = ['name'];

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
