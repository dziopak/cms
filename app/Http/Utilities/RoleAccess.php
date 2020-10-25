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


    static function unserializeAccess($access)
    {
        $res = [];
        if (!empty($access)) {
            foreach (unserialize($access) as $role_access) {
                $res[$role_access] = 1;
            }
        }

        return $res;
    }
}
