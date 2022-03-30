<?php

namespace App\Http\Controllers;

use App\Repository\IPermissionRoleRepository;
use Illuminate\Cache\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class RolePermissionController extends Controller
{
    private IPermissionRoleRepository $iPermissionRoleRepository;

    public function __construct(IPermissionRoleRepository $iPermissionRoleRepository)
    {
        $this->iPermissionRoleRepository = $iPermissionRoleRepository;
    }

    public function getAllGrantPermission() {
        return response()->json([
           'data' => $this->iPermissionRoleRepository->getAllGrantPermission()
        ]);
    }

    public function createGrantPermission(Request $request)
    {
        $current_date_time = Carbon::now();
        $role_id = $request->input('role_id');
        $permission_id = $request->input('permission_id');
        $data = array(
            "role_id" => $role_id,
            "permission_id" => $permission_id ,
            "created_at" => $current_date_time,
            "updated_at"=> $current_date_time,
        );

        return response()->json([
            $this->iPermissionRoleRepository->createGrantPermission($data) => 'create grant permission success'
        ], ResponseAlias::HTTP_CREATED);
    }

    public function findGrantPermissionById(Request $request){
        $isRole = $request->get('role_id');
        $isPermission = $request->get('permission_id');
        return \response()->json([
           'Notification' => $this->iPermissionRoleRepository->isGrantPermissionById($isRole,$isPermission)
        ]);
    }

    /**
     * ???????????
     * @param Request $request
     * @return JsonResponse
     */
    public function updateGrantPermission(Request $request){
        $roleId = $request->get('role_id');
        $permissionId = $request->get('permission_id');
        $details = $request->only([
            'role_id',
            'permission_id',
        ]);
        return \response()->json([
           'data' => $this->iPermissionRoleRepository->updateGrantPermission($roleId,$permissionId,$details)
        ]);
    }

    public function deleteGrantPermission(Request $request)
    {
        $roleId = $request->get('role_id');
        $permissionId = $request->get('permission_id');
        return \response()->json([
            'Notification' => $this->iPermissionRoleRepository->deleteGrantPermission($roleId, $permissionId)
        ]);
    }

    public function findGrantPermissionByIdRole(Request $request)
    {
        $isRole = $request->get('role_id');
        return \response()->json([
            'data' => $this->iPermissionRoleRepository->finGrantPermissionByIdRole($isRole)
        ]);
    }

}
