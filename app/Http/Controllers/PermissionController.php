<?php

namespace App\Http\Controllers;

use App\Models\account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repository\IPermissionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PermissionController extends Controller
{
    private IPermissionRepository $permissionRepository;

    public function __construct( IPermissionRepository $iPermissionRepository)
    {
        $this->permissionRepository = $iPermissionRepository;
        $this->middleware('auth:api');
    }

    /**
     * get all permission
     * @return JsonResponse
     */
    public function getAllPermission(){
        return $this->permissionRepository->getAllPermission();
    }

    /**
     * Create a permission
     * @param Request $request
     * @return mixed
     */
    public function createPermission(Request $request){
        $current_date_time = Carbon::now('Asia/Ho_Chi_Minh');
        $id = Uuid::uuid4()->toString();
        $title = $request->input('name');

        $data = array(
            "id" => $id,
            "name" => $title,
            "modified_by_id" => Auth::id(),
            "created_by_id" => Auth::id(),
            "created_at" => $current_date_time,
            "updated_at"=> $current_date_time,
        );

        return $this->permissionRepository->createPermission($data);
    }

    /**
     * Find permission by id
     * @param Request $request
     * @return mixed
     */
    public function findPermissionById(Request $request)
    {
        $idPermission = $request->route('id');
        return $this->permissionRepository->findPermissionById($idPermission);
    }

    /**
     * update permission by id
     * @param Request $request
     * @return mixed
     */
    public function updatePermissionById(Request $request)
    {
        $id = $request->route('id');
        $name = $request->get('name');

        $data = array(
            "name" => $name,
            "modified_by_id" => Auth::id(),
        );

        return $this->permissionRepository->updatePermission($id, $data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deletePermissionById(Request $request) {
        $id = $request->route('id');
        return $this->permissionRepository->deletePermission($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findPermissionByName(Request $request){
        $name = $request->get('name');
        return  $this->permissionRepository->findPermissionByName($name);
    }


    public function finPermissionById(Request $request)
    {
        $id = $request->route('id');
        return \response()->json([ $this->permissionRepository->isPermissionById($id)
        ]);
    }
}
