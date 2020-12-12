<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Auth;

class MenuItem extends Model
{
    use QueryCacheable;

    protected $guarded = [];
    public $timestamps = false, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public function menu()
    {
        return $this->belongsTo('App\Entities\Menu');
    }

    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'parent');
    }

    private function checkConditions()
    {
        $err = false;
        $conditions = unserialize($this->conditions);

        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $err = $this->verify($condition);
            }
        }
        return !$err ? true : false;
    }

    private function verify($condition)
    {
        switch ($condition) {
            case 'logged_in':
                if (Auth::check() !== true) return true;
                break;

            case 'logged_out':
                if (Auth::check() === true) return true;
                break;

            case 'is_admin':
                if (!Auth::check() || !Auth::user()->hasAccess('ADMIN_VIEW')) return true;
                break;

            case 'verified':
                if (!(!empty(Auth::user()->email_verified_at))) return true;
                break;
        }

        return false;
    }

    public function scopeGetItems($query)
    {
        $query = $query->get()->filter(function ($item) {
            if ($item->checkConditions()) return $item;
        });
        return $query;
    }
}
