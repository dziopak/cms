<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'target_id', 'type', 'crud_action', 'message', 'target_name'];
    protected $table = 'logs';


    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


    public function target()
    {
        switch ($this->type) {
            case 'USER':
                return $this->belongsTo('App\Models\User', 'target_id', 'id');
                break;

            case 'ROLE':
                return $this->belongsTo('App\Models\Role', 'target_id', 'id');
                break;

            case 'POST':
                return $this->belongsTo('App\Models\Post', 'target_id', 'id');
                break;

            case 'POST_CATEGORY':
                return $this->belongsTo('App\Models\PostCategory', 'target_id', 'id');
                break;

            case 'PAGE':
                return $this->belongsTo('App\Models\Page', 'target_id', 'id');
                break;

            case 'PAGE_CATEGORY':
                return $this->belongsTo('App\Models\PageCategory', 'target_id', 'id');
                break;
        }
    }
}
