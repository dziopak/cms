<?php

namespace Plugins\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class ContentBox extends Model
{
    protected $guarded = [];
    protected $table = 'portfolio_content_boxes';
    public $timestamps = false;
}
