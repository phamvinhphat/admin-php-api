<?php

namespace App\Repository;

use App\service\PermissionService;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StatusRepository implements IStatusRepository
{

    private IUserRepository $iUserRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository, PermissionService $permissionService)
    {
        $this->iUserRepository = $iUserRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function createStatus(array $data)
    {

        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"status","create");
        if($isAdmin == true || $isRole == true)
        {
            $validator = Validator::make($data, [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(
                    ["message" => $validator->errors()],
                    ResponseAlias::HTTP_UNAUTHORIZED
                );
            }

            return response()->json(
                ["result" => DB::table('status')->insert($data)],
                ResponseAlias::HTTP_CREATED
            );
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findStatusById($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"status","find");
        if($isAdmin == true || $isRole == true)
        {
            $find = DB::table('status')->find($id);
            if (!is_null($find)) {
                return response()->json([
                    "result" => DB::table('status')->find($id)
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                    "message" => "Not Found"
                ],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @return JsonResponse
     */
    public function getAllStatus()
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"status","view");
        if($isAdmin == true || $isRole == true) {
            return response()->json([
                "result" => DB::table('status')->get()
            ]);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkIdStatus($id)
    {
        $isCheckIdStatus = DB::table('status')->find($id);
        if (!is_null($isCheckIdStatus)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteStatusById($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"status","delete");
        if($isAdmin == true || $isRole == true) {
            if($this->checkIdStatus($id) == true)
            {
                return response()->json([
                   "result" => DB::table('status')->delete($id)
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                    "message" => "Not Found"
                ],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @param array $data
     * @return JsonResponse
     */
    public function updateStatusById($id, array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(
                ["message" => $validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"status","update");
        if($isAdmin == true || $isRole == true)
        {
            if($this->checkIdStatus($id) == true)
            {
                return response()->json([
                   "result" => DB::table('status')
                        ->where('id', $id)
                        ->update($data)
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                    "message" => "Not Found"
                ],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"
            ],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }


    public function findStatusByMyId($id)
    {
        $result = DB::table('status')
            ->where('created_by_id' , '=', $id)
            ->get();
        if(!is_null($result))
        {
            return response()->json([
                "result" => $result
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Not Found"
            ], ResponseAlias::HTTP_OK);
        }
    }
}
