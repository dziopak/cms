<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\File;
use App\Traits\EntityTrait;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderEntity as WebEntity;

class Slider extends Model
{
    use EntityTrait;

    public $timestamps = false, $cacheFor = 3600;
    protected $fillable = ['name'];
    protected static $flushCacheOnUpdate = true;

    private $webEntity = WebEntity::class;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
