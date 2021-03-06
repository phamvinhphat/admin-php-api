<?php

namespace App\Repository;
use App\Models\rolePermissions;
use App\service\PermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PermissionRoleRepository implements IPermissionRoleRepository
{

    private IUserRepository $userRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository, PermissionService $permissionService)
    {
        $this->userRepository = $iUserRepository;
        $this->permissionService = $permissionService;
    }


    /**
     * get view grant permission all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function CreateGrantPermission($data)
    {
        $validator = Validator::make($data, [
            'role_id' => 'bail|required|uuid',
            'permission_id' =>  'bail|required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permissionRole","create");
        if($isAdmin == true || $isRole == true) {
            return response()->json([
                "result" => DB::table('role_permissions')->insert($data)
            ], ResponseAlias::HTTP_CREATED);
        } else {
            return response()->json([
                "message" => 'You Do Not Have Access'],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * get view grant permission all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getAllGrantPermission()
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permissionRole","view");
        if($isAdmin == true || $isRole == true) {
            return response()->json(
                ["result" => DB::table('role_permissions')->get()],
                ResponseAlias::HTTP_OK
            );
        } else {
            return response()->json([
                "message" => 'You Do Not Have Access'],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * BUG :((
     * @param $idRole
     * @param $idPermission
     * @param array $data
     * @return JsonResponse|int
     */
    public function updateGrantPermission($idRole, $idPermission, array $data)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permissionRole","update");
        if($isAdmin == true || $isRole == true)
        {
            if($this->isGrantPermissionById($idRole,$idPermission)){
                return DB::table('role_permissions')
                    ->where("role_permissions.role_id",'=',$idRole)
                    ->where("role_permissions.permission_id",'=',$idPermission)
                    ->update($data);
            } else {
                return response()->json(["message"=>"Grant Permission Not Found"],404);
            }
        } else {
            return response()->json([
                "message" => 'You Do Not Have Access'],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function deleteGrantPermission($idRole, $idPermission)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permissionRole","delete");
        if($isAdmin == true || $isRole == true)
        {
            if ($this->isGrantPermissionById($idRole, $idPermission)) {
                return response()->json(
                        ["result" =>DB::table('role_permissions')
                        ->where("role_permissions.role_id", '=', $idRole)
                        ->where("role_permissions.permission_id", '=', $idPermission)
                        ->delete()],
                ResponseAlias::HTTP_OK);
            } else {
                return response()->json(
                    ["message" => "Grant Not Found"],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
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
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permissionRole","find");
        if($isAdmin == true || $isRole == true) {
            $isId = DB::table('role_permissions')
                ->where('role_id', $idRole)
                ->get();
            if (!is_null($isId)) {
                return response()->json(
                    ["result" =>  $isId],
                    ResponseAlias::HTTP_OK
                );
            } else {
                return response()->json(
                    ["message" => "Gran Permission Not Found"],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }
}
