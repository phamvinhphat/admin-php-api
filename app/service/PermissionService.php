<?php

namespace App\service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    public function checkPermission($id, $table, $Permission )
    {
        $checkRoleById = DB::table('account')
            ->where('id', $id)
            ->value('account.role_id');

        if(!is_null($checkRoleById)){
            $getPermissionById = DB::table('role_permissions')
                ->select('permission_id')
                ->where('role_id', $checkRoleById)
                ->pluck('role_permissions.permission_id');
            if(!is_null($getPermissionById))
            {
                $name = "$table.$Permission";
                $getNamePermission = DB::table('permission')
                    ->whereIn('id', $getPermissionById)
                    ->where('name','=',$name)
                    ->first();

                if(!is_null($getNamePermission))
                {
                    return true;
                } else {
                    return false;
                }
            } else {
                return response()->json([
                    "message" => "Role Permission Not Found"
                ]);
            }
        } else {
            return response()->json([
                "message" => "Role Not Found"
            ]);
        }

    }
}
