<?php

namespace App\Repository;

use App\Models\account;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class UserRepository implements IUserRepository
{
    /**
     * get view user all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getAllUser()
    {
        return account::all();
    }


    /**
     * create new user
     * @param array $orderDetails
     * @return int
     * @throws ModelNotFoundException
     */
    public function register(array $orderDetails)
    {
        return 0;
    }

    /**
     * find user by id
     * @param string $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getUserById($id)
    {
        $check = DB::table('account')->find($id);
        if(is_null($check)){
            return \response()->json(['error' => 'not found'],404);
        } else {
            return $check;
        }
    }

    /**
     * update role have user
     * @param $id
     * @param string $roleID
     * @return int
     */
    public function updateRoleById($id, string $roleID)
    {
       return DB::table('account')
            ->where("account.id", '=', $id)
            ->update(['account.role_id'=> $roleID]);
//        $product = DB::table('account')->find($id);;
//        $product->update($request);
//        return $product;
//        return DB::table('account')->where($id)->update($newDetails);
    }

    /**
     * update info user
     * @param $userId
     * @param array $newDetails
     * @return int
     */
    public function updateUser($userId, array $newDetails)
    {
        return DB::table('account')->where($userId)->update($newDetails);
    }

    public function getRoleByIdUser($id)
    {
        // TODO: Implement getRoleByIdUser() method.
    }

    public function checkRole($id)
    {
        $isAdmin = DB::table('account')->where('is_admin',true)->find($id);

        if(!is_null($isAdmin)){
            return true;
        } else {
            return false;
        }

    }

    public function changeIsRole($id, bool $isAdmin)
    {
        if($this->checkRole($id)) {
            return DB::table('account')
                ->where("account.id", '=', $id)
                ->update(['account.is_admin' => $isAdmin]);
        } else {
            return \response()->json(['error' => 'Authentication'],400);
        }

    }
}
