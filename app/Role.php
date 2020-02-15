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
}
