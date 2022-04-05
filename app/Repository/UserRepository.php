<?php

namespace App\Repository;

use App\Models\account;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function response;


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
     * find user by id
     * @param string $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getUserById($id)
    {
        $check = DB::table('account')->find($id);
        if (is_null($check)) {
            return response()->json(['error' => 'not found'], 404);
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
            ->update(['account.role_id' => $roleID]);
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

    public function changeIsRole($id, bool $isAdmin)
    {
        if ($this->checkRole($id)) {
            return DB::table('account')
                ->where("account.id", '=', $id)
                ->update(['account.is_admin' => $isAdmin]);
        } else {
            return response()->json(['error' => 'Authentication'], 400);
        }
    }

    public function checkRole($id)
    {
        $isAdmin = DB::table('account')->where('is_admin', true)->find($id);

        if (!is_null($isAdmin)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $infoUser
     * @return JsonResponse
     */

    public function login($infoUser)
    {
        $validator = Validator::make($infoUser, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($infoUser))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
            return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     * @param  $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => "Bearer $token",
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    /**
     * @param array $infUser
     * @return JsonResponse | bool
     */
    public function signUp(array $infUser)
    {
        $validator = Validator::make($infUser, [
            'email' => 'required|email|unique:account',
            'password' => 'bail|required|min:8',
            'username' => 'bail|required|alpha|min:4|max:12|unique:account',
            'first_name' => 'bail|required',
            'last_name'  => 'bail|required',
            'id_card' => 'bail|required|min:12|max:12|unique:account',
            'phone_number' => 'bail|required|min:10|max:10|unique:account',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        return DB::table('account')->insert($infUser);
    }

    public function logout()
    {
        auth()->logout();
        return ['message' => 'User successfully signed out'];
    }
}
