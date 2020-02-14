<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'target_id', 'type', 'crud_action', 'message'];
    protected $table = 'logs';

    public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function target() {
        return $this->belongsTo('App\User', 'target_id', 'id');
    }
}
