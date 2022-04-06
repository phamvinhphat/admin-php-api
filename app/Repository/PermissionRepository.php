<?php

namespace App\Repository;

use App\Models\permission;
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

    public function __construct(IUserRepository $iUserRepository)
    {
        $this->iUserRepository = $iUserRepository;
    }

    /**
     * get view permission all
     * @return JsonResponse
     */
    public function getAllPermission()
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        if ($isAdmin == true) {
            $getAll = DB::table('permission')->get();
            if (!is_null($getAll)) {
                return response()->json([
                    'Result' => $getAll
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json(["Null" => $getAll], ResponseAlias::HTTP_OK);
            }
        } else {
            return response()->json([
                'error' => 'You are not admin'],
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
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());

        $validator = Validator::make($data, [
            'name' => 'bail|required',
        ]);
        if ($validator->fails()) {
            return response()->json(
                ['Error'=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        if ($isAdmin == true) {
            return response()->json(
                [
                    "Result" => DB::table('permission')->insert($data)
                ],
                ResponseAlias::HTTP_CREATED
            );
        } else {
            return response()->json([
                'Error' => 'You are not admin'],
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
        if ($isAdmin == true) {
            $isId = DB::table('permission')->find($id);
            if (is_null($isId)) {
                return response()->json(
                    ['Error' => 'Permission Not Found'],
                    ResponseAlias::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    "Result" => $isId
                ], ResponseAlias::HTTP_OK);
            }
        } else {
            return response()->json([
                'Error' => 'You are not admin'],
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
        if ($isAdmin == true) {
            $isTitle = DB::Table('permission')->where('name','=',$name)->get();
            if (is_null($isTitle)) {
                return response()->json(
                    ['Error' => 'Permission Not Found'],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            } else {
                return response()->json(
                    ['Result' => $isTitle],
                    ResponseAlias::HTTP_OK
                );
            }
        } else {
            return response()->json([
                'Error' => 'You are not admin'],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * update permission by id
     * @param $id
     * @param string $name
     * @return JsonResponse
     */
    public function updatePermission($id, array $data)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());

        $validator = Validator::make($data, [
            'name' => 'bail|required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['Error'=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }


        if ($isAdmin == true) {
            if ($this->isPermissionById($id) == true) {
                return response()->json(
                    [
                        'Result' => DB::table('permission')
                        ->where("permission.id", '=', $id)
                        ->update($data)
                    ],
                    ResponseAlias::HTTP_OK
                );
            } else {
                return response()->json(
                    ['Error' => 'Permission Not Found'],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['Error' => 'You are not admin'],
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

        if ($isAdmin == true) {
            if ($this->isPermissionById($id) == true) {
                return response()->json(
                    [
                        'Result' => permission::destroy($id)
                    ],
                );
            } else {
                return response()->json(
                    ['Error' => 'Permission Not Found'],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['Error' => 'You are not admin'],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }
}
