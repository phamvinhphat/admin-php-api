<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IPermissionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PermissionController extends Controller
{
    private IPermissionRepository $iPermissionRepository;

    public function __construct( IPermissionRepository $iPermissionRepository)
    {
        $this->iPermissionRepository = $iPermissionRepository;
    }

    public function getAllPermission(){
        return response()->json([
           'data' => $this->iPermissionRepository->getAllPermission()
        ]);
    }

    public function createPermission(Request $request){
        $current_date_time = Carbon::now();
        $id = Uuid::uuid4()->toString();
        $title = $request->input('permission_title');
        $data = array(
            "id" => $id,
            "permission_title"=>$title,
            "created_at" => $current_date_time,
            "updated_at"=> $current_date_time,
        );
        return response()->json([
           'data'=>$this->iPermissionRepository->createPermission($data)
        ], ResponseAlias::HTTP_CREATED);
    }

    public function findPermissionById($id)
    {
        return response()->json([
            'data' => $this->iPermissionRepository->findPermissionById($id)
        ],200);
    }

    public function updatePermissionById(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->get('permission_title');
        return response()->json([
            'data' => $this->iPermissionRepository->updatePermission($orderId, $orderDetails)
        ]);
    }

    public function deletePermissionById(Request $request){
        $orderId = $request->route('id');
        return response()->json([
            $this->iPermissionRepository->deletePermission($orderId)
        ], ResponseAlias::HTTP_ACCEPTED);
    }

    // BUG
    public function findPermissionByTitle(Request $request){
        $title = $request->route('permission_title');
        return response()->json([
            'data' => $this->iPermissionRepository->findPermissionByTitle($title)
        ]);
    }

}
