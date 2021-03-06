<?php

namespace App\Repository;

use App\Models\account;
use App\service\PermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use function response;


class UserRepository implements IUserRepository
{

    private PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * get view user all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getAllUser()
    {

        $isRole = $this->permissionService->checkPermission(Auth::id(),"account","view");
        if($this->checkRole(Auth::id()) == true || $isRole == true)
        {
            return response()->json([
                "result" => account::all()
            ],ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * find user by id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getMyInfo()
    {
        $check = $this->findUserById(Auth::id());

        if ($check == false) {
            return response()->json(["message" => "Not Found"], ResponseAlias::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["result" => DB::table('account')->find(Auth::id())], ResponseAlias::HTTP_OK);
        }
    }

    /**
     * update role have user$getUser
     * @param $id
     * @param string $roleID
     * @return JsonResponse
     */
    public function updateRoleById($id, string $roleID)
    {

        $isCheckAdmin = $this->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"account","update");
        if($isCheckAdmin == true || $isRole == true)
        {
            return response()->json([
                "result" => DB::table('account')
                    ->where("account.id", '=', $id)
                    ->update(['account.role_id' => $roleID])
            ],ResponseAlias::HTTP_OK);
        } else {
            return response()->json(["message" => "You Do Not Have Access"],ResponseAlias::HTTP_FORBIDDEN);
        }
    }

    /**
     * update info user
     * @param array $newDetails
     * @return JsonResponse
     *      "dob" => $dob,
    "gender" => $gender,
     */
    public function updateUser(array $newDetails)
    {
         $validator = Validator::make($newDetails, [
             'first_name' => 'required',
             'last_name'  => 'required',
             'dob' => 'required',
             'gender' => 'required',
             'id_card' => 'required|min:12|max:12|unique:account',
             'phone_number' => 'required|min:10|max:10|unique:account',
         ]);
        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        if($this->findUserById(Auth::id()) == true)
        {
            return response()->json([
               "result" => DB::table('account')->where('id', Auth::id())->update($newDetails)
            ],ResponseAlias::HTTP_OK);
        } else {
            return response()->json(["message" => "Not Found"],ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function getRoleByIdUser($id)
    {
        // TODO: Implement getRoleByIdUser() method.
    }

    /**
     * find user by id
     * @param $id
     * @return bool JWT repository laravel
     */
    public function findUserById($id)
    {
        $isCheckRole = DB::table('account')->find($id);
        if(!is_null($isCheckRole))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * change role(bool) by id
     * @param $id
     * @param bool $isAdmin
     * @return JsonResponse
     */
    public function changeIsRole($id, bool $isAdmin)
    {
        $isCheckAdmin = $this->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"account","updateRole");
        if($isCheckAdmin == true || $isRole == true)
        {
            return response()->json(
                ["result" => DB::table('account')
                    ->where("account.id", '=', $id)
                    ->update(['account.is_admin' => $isAdmin])],
                ResponseAlias::HTTP_OK
            );
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * check role by id
     * @param $id
     * @return bool
     */
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
     * login
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
            return response()->json(
                $validator->errors(),
                ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (! $token = auth()->attempt($infoUser))
        {
            return response()->json(
                ["message" => "Unauthorized"],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
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
        return response()->json(["result" =>[
            "accessToken" => "Bearer $token",
            "expiresIn" => auth()->factory()->getTTL() * 6000]
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * register
     * @param array $infUser
     * @return JsonResponse
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
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $createUser = DB::table('account')->insert($infUser);

        return response()->json(
            ["result" => $createUser],
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * logout
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(
            ["result" => "User successfully signed out"],
            ResponseAlias::HTTP_OK
        );
    }

    /**
     * refresh JWT
     * @return JsonResponse
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json(["result" => [
            "accessToken" => "Bearer $token",
            "expiresIn" => auth()->factory()->getTTL() * 60000]
        ], ResponseAlias::HTTP_OK);
    }

    public function changePassword($id, $pass)
    {
        $messages = [
            'password.required' => 'Please enter your current password',
            ];
        $validator = Validator::make($pass, [
            'password' => 'required',
            ], $messages);
        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $account = DB::table('account')->find(Auth::id());

        if(!Hash::check($pass, $account->password))
        {
            return response()->json(
                ['message' => 'Current password does not match'], ResponseAlias::HTTP_BAD_REQUEST);
        } else {
            $account->password = Hash::make($pass);
            $account->save();

            return $account;
        }
    }



}
