<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Factories\EntityFactory;
use DB;

class Role extends Model
{
    use QueryCacheable;

    public $timestamps = false;
    public $fire_events = true;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'roles';

    protected $fillable = ['name', 'access', 'description'];

    public static function get_all_roles()
    {
        $roles = [];
        foreach (self::all() as $role) {
            $roles[$role->id] = $role->name;
        }
        return $roles;
    }


    public function scopeFilter($query, $request)
    {
        if (!empty($request->get('search'))) {

            // Search in name //
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if (!empty($request->get('sort_by'))) {

            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        }
    }


    public function users()
    {
        return $this->hasMany('App\Entities\User', 'role_id');
    }

    public function permissions()
    {
        return $this->hasMany('App\Entities\Permission', 'role_id');
    }

    public function hasAccess($access)
    {
        $query = $this->permissions()->where('name', $access)->first();
        return (!empty($query)) ? true : false;
    }

    public function getPermissions()
    {
        return $this->permissions()->pluck('name');
    }

    public function withPermissions()
    {
        $this->attributes['access'] = [];
        foreach ($this->getPermissions() as $item) {
            $this->attributes['access'][$item] = true;
        }
        return $this;
    }
}
