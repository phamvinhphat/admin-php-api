<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Repository\IRoleRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class RoleController extends Controller
{
    private IRoleRepository $roleRepository;

    public function __construct(IRoleRepository $iRoleRepository)
    {
        $this->roleRepository = $iRoleRepository;
        $this->middleware('auth:api');
    }

    public function getAllRole(){
        return $this->roleRepository->getAllRole();
    }

    public function getMyRole()
    {
        return $this->roleRepository->getMyRole(Auth::id());
    }
    public function createRole(Request $request)
    {
        $id = Uuid::uuid4()->toString();
        $name = $request->get('name');

        $DB= array(
            "id"=> $id,
            "name"=>$name,
            "modified_by_id" => Auth::id(),
            "created_by_id" => Auth::id(),
            "created_at" => Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at" => Carbon::now('Asia/Ho_Chi_Minh'),
        );

        return $this->roleRepository->createRole($DB);
    }
    public function deleteRole(Request $request)
    {
        $id = $request->route('id');
        return $this->roleRepository->deleteRole($id);
    }
    public function updateRole(Request $request)
    {
        $id = $request->route('id');
        $name = $request->get('name');
        $DB= array(
            'name'=>$name,
            'modified_by_id' => Auth::id(),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        );

        return $this->roleRepository->updateRole($id,$DB);
    }

    public function listAdmin()
    {
        return response()->json([
            "result" => $this->roleRepository->listAdmin()
        ], ResponseAlias::HTTP_OK);
    }

    public function listUser()
    {
        return response()->json([
            "result" => $this->roleRepository->listUser()
        ],ResponseAlias::HTTP_OK);
    }

    public function countListAdmin()
    {
        return response()->json([
            "result"=>$this->roleRepository->countListAdmin()
        ],ResponseAlias::HTTP_OK);
    }

    public function countListUser()
    {
        return response()->json([
            "result"=>$this->roleRepository->countListUser()
        ],ResponseAlias::HTTP_OK);
    }

}
