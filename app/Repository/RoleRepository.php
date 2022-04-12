<?php

namespace App\Repository;

use App\service\PermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RoleRepository implements IRoleRepository
{

    private IUserRepository $userRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository, PermissionService $permissionService)
    {
        $this->userRepository = $iUserRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * get view role all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getAllRole()
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"role","create");
        if($isAdmin == true || $isRole == true) {
            return response()->json(["result" => DB::table('role')->get()], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function getMyRole($id)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"role","create");
        if($isAdmin == true || $isRole == true) {
                $idRole = DB::table('account')->where('id', $id)->value('role_id');
                $nameRole = DB::table('role')->where('id', $idRole)->get('name');
                return response()->json([
                    "result" => $nameRole
                ],ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function createRole($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"role","create");
        if($isAdmin == true || $isRole == true) {
            return response()->json([
                "result" => DB::table('role')->insert($data)
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function deleteRole($id)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"role","delete");
        if($isAdmin == true || $isRole == true) {
            return response()->json([
                "result" => DB::table('role')->delete($id)
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function updateRole($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"role","update");
        if($isAdmin == true || $isRole == true) {
            return response()->json([
                "result" => DB::table('role')->where('id', $id)->update($data)
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function listAdmin()
    {
        return DB::table('role')
            ->select('account.username', 'account.email','account.first_name', 'role.name as roleName','account.created_at', 'account.updated_at')
            ->join('account','account.role_id','=','role.id')
<<<<<<< HEAD
            ->where('role.name', '=', 'Admin')
=======
            ->where('role.name', '=', 'ADMIN')
>>>>>>> e53b42e4ec44c0846bf32ce5bc6312128a33b468
            ->get();
    }

    public function listUser()
    {
        return DB::table('role')
            ->select('account.username', 'account.email','account.first_name', 'role.name as roleName','account.created_at', 'account.updated_at')
            ->join('account','account.role_id','=','role.id')
<<<<<<< HEAD
            ->where('role.name', '=', 'User')
=======
            ->where('role.name', '=', 'USER')
>>>>>>> e53b42e4ec44c0846bf32ce5bc6312128a33b468
            ->get();
    }


    public function countListAdmin()
    {
        return DB::table('role')
            ->join('account','account.role_id','=','role.id')
<<<<<<< HEAD
            ->where('name', '=', 'Admin')
=======
            ->where('name', '=', 'ADMIN')
>>>>>>> e53b42e4ec44c0846bf32ce5bc6312128a33b468
            ->count();
    }

    public function countListUser()
    {
        return DB::table('role')
            ->join('account','account.role_id','=','role.id')
<<<<<<< HEAD
            ->where('name', '=', 'User')
            ->count();
    }


=======
            ->where('name', '=', 'USER')
            ->count();
    }
>>>>>>> e53b42e4ec44c0846bf32ce5bc6312128a33b468
}
