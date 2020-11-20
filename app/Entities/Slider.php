<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\File;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderActions;
use App\Traits\EntityTrait;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderEntity as WebEntity;
use App\Traits\MassEditable;

class Slider extends Model
{
    use EntityTrait, MassEditable;

    public $timestamps = false, $cacheFor = 3600;
    protected $fillable = ['name'];
    protected static $flushCacheOnUpdate = true;

    protected $webEntity = WebEntity::class;
    protected $massActions = SliderActions::class;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
