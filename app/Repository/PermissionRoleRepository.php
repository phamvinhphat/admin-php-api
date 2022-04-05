<?php

namespace App\Repository;
use App\Models\rolePermissions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PermissionRoleRepository implements IPermissionRoleRepository
{
    /**
     * get view grant permission all
     * @return bool
     * @throws ModelNotFoundException
     */
    public function CreateGrantPermission($data)
    {
        return DB::table('role_permissions')->insert($data);
    }

    /**
     * get view grant permission all
     * @return Collection
     * @throws ModelNotFoundException
     */
    public function getAllGrantPermission()
    {
        return DB::table('role_permissions')->get();
    }

    public function updateGrantPermission($idRole, $idPermission, array $data)
    {
        if($this->isGrantPermissionById($idRole,$idPermission)){
            return DB::table('role_permissions')
                ->where("role_permissions.role_id",'=',$idRole)
                ->where("role_permissions.permission_id",'=',$idPermission)
                ->update($data);
        } else {
            return \response()->json(['error'=>'Grant Permission Not Found'],404);
        }
    }

    public function deleteGrantPermission($idRole, $idPermission)
    {
        if($this->isGrantPermissionById($idRole,$idPermission)) {
            return \response()->json([DB::table('role_permissions')
                ->where("role_permissions.role_id", '=', $idRole)
                ->where("role_permissions.permission_id", '=', $idPermission)
                ->delete()
            ]);
        } else {
            return \response()->json(['ERROR'=>'Grant Not Found'],404);
        }
    }

    /**
     *  find grant permission by id
     * @param $idRole
     * @param $idPermission
     * @return bool
     */
    public function isGrantPermissionById($idRole, $idPermission)
    {
        $isId = DB::table('role_permissions')
            ->where("role_permissions.role_id",'=',$idRole)
            ->where("role_permissions.permission_id",'=',$idPermission)
            ->first();
        if(!is_null($isId)){
            return true;
        } else {
            return false;
        }
    }

    public function finGrantPermissionByIdRole($idRole)
    {
        $isId = DB::table('role_permissions')
            ->where('role_id', $idRole)
            ->get();
        if(!is_null($isId)){
            return $isId;
        } else {
            return response()->json(["ERROR"=>"Gran Permission Not Found"],404);
        }
    }
}
