<?php

namespace App\Repository;
use App\Models\permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements IPermissionRepository
{

    /**
     * get view permission all
     * @return Collection
     */
    public function getAllPermission()
    {
        return DB::table('permission')->get();
    }

    /**
     * create permission
     * @param array $data
     * @return bool
     */
    public function createPermission(array $data)
    {
       return DB::table('permission')->insert($data);
    }

    /**
     * find user by id
     * @param string $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function findPermissionById($id)
    {
        $isId = DB::table('permission')->find($id);
        if(is_null($isId)){
            return \response()->json(['error' => 'permission not found'],404);
        } else {
            return $isId;
        }
    }

    /**
     * find user by id
     * @param string $id
     * @return boolean
     * @throws ModelNotFoundException
     */
    public function isPermissionById($id)
    {
        $isId = DB::table('permission')->find($id);
        if(!is_null($isId)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * find permission by id
     * @param string $title
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function findPermissionByTitle(string $title)
    {
        $isTitle = DB::Table('permission')->find($title);
        if(is_null($isTitle)){
            return \response()->json(['error' => 'permission not found'],404);
        } else {
            return $isTitle;
        }
    }

    /**
     * update permission by id
     * @param $id
     * @param string $Title
     * @return JsonResponse|int
     */
    public function updatePermission($id, string $Title)
    {
        if($this->isPermissionById($id)){
            return DB::table('permission')
                ->where("permission.id", '=', $id)
                ->update(['permission.permission_title'=> $Title]);
        } else {
            return \response()->json(['error' => 'permission not found'],404);
        }
    }

    /**
     * delete permission
     * @param $id
     * @return JsonResponse|int
     */
    public function deletePermission($id)
    {
        if($this->isPermissionById($id)) {
            return permission::destroy($id);
        } else {
            return \response()->json(['error' => 'permission not found'],404);
        }
    }
}
