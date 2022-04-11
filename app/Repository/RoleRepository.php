<?php

namespace App\Repository;

use App\service\PermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Models\role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use function GuzzleHttp\Promise\all;

class RoleRepository implements IRoleRepository
{

    private IUserRepository $iUserRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository, PermissionService $permissionService)
    {
        $this->iUserRepository = $iUserRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * get view role all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getAllRole()
    {
        return response()->json(["result" => DB::table('role')->get()],ResponseAlias::HTTP_OK);
    }

    public function getMyRole($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"permissionRole","create");
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

        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
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
        // TODO: Implement deleteRole() method.
    }

    public function updateRole($id, $data)
    {
        // TODO: Implement updateRole() method.
    }
}
