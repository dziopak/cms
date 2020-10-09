<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\Roles\RoleCreateEvent;
use App\Events\Roles\RoleUpdateEvent;
use App\Events\Roles\RoleDestroyEvent;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'access', 'description'];
    public $fire_events = true;

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
        return $this->hasMany('App\User', 'role_id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            $role->users()->update(['role_id' => '1']);
        });

        self::created(function ($role) {
            if ($role->fire_events) event(new RoleCreateEvent($role));
        });

        self::updated(function ($role) {
            if ($role->fire_events) event(new RoleUpdateEvent($role));
        });

        self::deleted(function ($role) {
            if ($role->fire_events) event(new RoleDestroyEvent($role));
        });
    }
}
