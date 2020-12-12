<?php

namespace App\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Role extends Model
{
    use Filterable, QueryCacheable;

    public $timestamps = false;
    public $fire_events = true;
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'roles';
    private $searchIn = ['name'];

    protected $fillable = ['name', 'access', 'description'];

    public static function get_all_roles()
    {
        $roles = [];
        foreach (self::all() as $role) {
            $roles[$role->id] = $role->name;
        }
        return $roles;
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
