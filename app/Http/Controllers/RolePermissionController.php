<?php

namespace App\Http\Controllers;

use App\Repository\IPermissionRoleRepository;
use Illuminate\Cache\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class RolePermissionController extends Controller
{
    private IPermissionRoleRepository $iPermissionRoleRepository;

    public function __construct(IPermissionRoleRepository $iPermissionRoleRepository)
    {
        $this->iPermissionRoleRepository = $iPermissionRoleRepository;
        $this->middleware('auth:api');
    }

    /**
     * get all grant Permission
     * @return mixed
     */
    public function getAllGrantPermission() {
        return  $this->iPermissionRoleRepository->getAllGrantPermission();
    }

    /**
     * create a grant permission
     * @param Request $request
     * @return JsonResponse
     */
    public function createGrantPermission(Request $request)
    {
        $current_date_time = Carbon::now('Asia/Ho_Chi_Minh');
        $role_id = $request->input('roleId');
        $permission_id = $request->input('permissionId');
        $data = array(
            "role_id" => $role_id,
            "permission_id" => $permission_id ,
            "modified_by_id" => Auth::id(),
            "created_by_id" => Auth::id(),
            "created_at" => $current_date_time,
            "updated_at"=> $current_date_time,
        );

        return $this->iPermissionRoleRepository->createGrantPermission($data);
    }

    /**
     * Find grant Permission by idPermission and idRole
     * @param Request $request
     * @return JsonResponse
     */
    public function findGrantPermissionById(Request $request){
        $isRole = $request->get('roleId');
        $isPermission = $request->get('permissionId');
        return \response()->json([
           'Notification' => $this->iPermissionRoleRepository->isGrantPermissionById($isRole,$isPermission)
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * ???????????(BUG)
     * @param Request $request
     * @return JsonResponse
     */
    public function updateGrantPermission(Request $request){
        $roleId = $request->get('roleId');
        $permissionId = $request->get('permissionId');
        $details = $request->only([
            'role_id',
            'permission_id',
        ]);
        return \response()->json([
           'data' => $this->iPermissionRoleRepository->updateGrantPermission($roleId,$permissionId,$details)
        ]);
    }

    /**
     * delete
     * @param Request $request
     * @return mixed
     */
    public function deleteGrantPermission(Request $request)
    {
        $roleId = $request->get('roleId');
        $permissionId = $request->get('permissionId');
        return $this->iPermissionRoleRepository->deleteGrantPermission($roleId, $permissionId);
    }

    /**
     * find
     * @param Request $request
     * @return JsonResponse
     */
    public function findGrantPermissionByIdRole(Request $request)
    {
        $isRole = $request->get('roleId');
        return $this->iPermissionRoleRepository->finGrantPermissionByIdRole($isRole);
    }

}
