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
        if(is_null($id)){
            return \response()->json(['error' => 'not found'],404);
        }
        return DB::table('account')->find($id);
    }

    /**
     * update role have user
     * @param $userId
     * @param array $collection
     * @return JsonResponse|int
     */
    public function updateRoleById($userId, array $collection)
    {
        if (is_null($userId)) {
            return response()->json(['error' => 'not found'], 404);
        }
        return DB::table('account')->where($userId)->update($collection);
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
}
