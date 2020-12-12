<?php

namespace App\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Carousel extends Model
{
    use HasFactory, QueryCacheable, Filterable;

    protected $fillable = ['name'];
    public $timestamps = false;
    private $searchIn = ['name'];

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
