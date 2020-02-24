<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'access', 'description']; 

    public function get_all_roles() {
        $roles = [];
        foreach($this->all() as $role) {
            $roles[$role->id] = $role->name;
        }
        return $roles;
    }

    public function scopeFilter($query, $request) {
        if (!empty($request->get('search'))) {

            // Search in name //
            $query->where('name', 'like', '%'.$request->get('search').'%');
        
        }
        if (!empty($request->get('sort_by'))) {

            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
            $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        
        }
    }
}
