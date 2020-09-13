<?php

namespace Plugins\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;
use plugins\Portfolio\Entities\PortfolioItem;

class PortfolioCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function items()
    {
        return $this->belongsToMany(PortfolioItem::class);
    }
}
