<?php

namespace App\Http\Utilities;

class RoleAccess
{


    static function serializeAccess($access)
    {
        $res = [];
        foreach ($access as $key => $row) {
            if ($row === '1') {
                array_push($res, $key);
            }
        }
        return serialize($res);
    }


    static function unserializeAccess($role)
    {
        $access = $role->permissions();
        foreach ($access as $permission) {
            $res[$permission->name] = true;
        }
        return $res;
    }
}
