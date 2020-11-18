<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Modules\Roles\RoleEntity;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Factories\EntityFactory;
use App\Traits\EntityTrait;

class Role extends Model
{
    use QueryCacheable, EntityTrait;

    public $timestamps = false;
    public $fire_events = true;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = ['name', 'access', 'description'];
    protected $webEntity = RoleEntity::class;

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

    public function duplicate()
    {
        return EntityFactory::build($this->webEntity, $this)->duplicate();
    }
}
