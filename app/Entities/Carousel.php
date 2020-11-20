<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Blocks\Carousels\CarouselActions;
use App\Http\Utilities\Admin\Blocks\Carousels\CarouselEntity;
use App\Traits\EntityTrait;
use App\Traits\MassEditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Carousel extends Model
{
    use HasFactory;
    use EntityTrait, MassEditable, QueryCacheable;

    protected $guarded = [];
    public $timestamps = false;

    protected $webEntity = CarouselEntity::class;
    protected $massActions = CarouselActions::class;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($carousel) {
            $carousel->files()->detach();
        });
    }
}
