<?php

namespace plugins\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class PortfolioItemPicture extends Model
{
    public $timestamps = false;
    protected $fillable = ['portfolio_item_id', 'path'];
}
