<?php

namespace Modules\UserCustomFields\Entities;

use Illuminate\Database\Eloquent\Model;

class UserCustomField extends Model
{
    protected $fillable = ['name', 'slug', 'index_display', 'type', 'required'];
}
