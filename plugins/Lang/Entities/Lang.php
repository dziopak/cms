<?php

namespace plugins\Lang\Entities;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $fillable = ['name', 'origin_name', 'lang_tag'];
}
