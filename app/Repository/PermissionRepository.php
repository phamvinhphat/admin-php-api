<?php

namespace App\Repository;

use App\Models\permission;
use App\service\PermissionService;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PermissionRepository implements IPermissionRepository
{
    private IUserRepository $iUserRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository, PermissionService $permissionService)
    {
        $this->iUserRepository = $iUserRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * get view permission all
     * @return JsonResponse
     */
    public function getAllPermission()
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permission","view");
        if($isAdmin == true || $isRole == true)
        {
            $getAll = DB::table('permission')->get();
            if (!is_null($getAll)) {
                return response()->json([
                    "result" => $getAll
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json(["message" => $getAll], ResponseAlias::HTTP_OK);
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * create permission
     * @param array $data
     * @return JsonResponse
     */
    public function createPermission(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'bail|required',
        ]);
        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permission","create");
        if($isAdmin == true || $isRole == true)  {
            return response()->json(
                [
                    "result" => DB::table('permission')->insert($data)
                ],
                ResponseAlias::HTTP_CREATED
            );
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * find user by id
     * @param string $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function findPermissionById($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permission","find");
        if($isAdmin == true || $isRole == true)
        {
            $isId = DB::table('permission')->find($id);
            if (is_null($isId)) {
                return response()->json(
                    ["message" => "Permission Not Found"],
                    ResponseAlias::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    "result" => $isId
                ], ResponseAlias::HTTP_OK);
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * find permission by name (search)
     * @param string $name
     * @return JsonResponse
     */
    public function findPermissionByName(string $name)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permission","findName");
        if($isAdmin == true || $isRole == true)
        {
            $isTitle = DB::Table('permission')->where('name','=',$name)->get();
            if (is_null($isTitle)) {
                return response()->json(
                    ["message" => 'Permission Not Found'],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            } else {
                return response()->json(
                    ["result" => $isTitle],
                    ResponseAlias::HTTP_OK
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
     * update permission by id
     * @param $id
     * @param array $data
     * @return JsonResponse
     */
    public function updatePermission($id, array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'bail|required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permission","update");
        if($isAdmin == true || $isRole == true)
        {
            if ($this->isPermissionById($id) == true) {
                return response()->json(
                    [
                        "result" => DB::table('permission')
                        ->where("permission.id", '=', $id)
                        ->update($data)
                    ],
                    ResponseAlias::HTTP_OK
                );
            } else {
                return response()->json(
                    ["Error" => "Permission Not Found"],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ["Error" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
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
        if (!is_null($isId)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete permission
     * @param $id
     * @return JsonResponse
     */
    public function deletePermission($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permission","delete");
        if($isAdmin == true || $isRole == true)
        {
            if ($this->isPermissionById($id) == true) {
                return response()->json(
                    [
                        "result" => permission::destroy($id)
                    ],
                );
            } else {
                return response()->json(
                    ['message' => 'Permission Not Found'],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }
}
