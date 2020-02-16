<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'target_id', 'type', 'crud_action', 'message', 'target_name'];
    protected $table = 'logs';

    public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function target() {
        switch($this->type) {
            case 'USER':
                return $this->belongsTo('App\User', 'target_id', 'id');
            break;

            case 'ROLE':
                return $this->belongsTo('App\Role', 'target_id', 'id');
            break;

            case 'POST':
                return $this->belongsTo('App\Post', 'target_id', 'id');
            break;
        }
    }
}
