<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $fillable = [];

    public function photos() {
        return $this->hasMany('Modules\Portfolio\Entities\PortfolioItemPicture', 'portfolio_item_id');
    }
}
