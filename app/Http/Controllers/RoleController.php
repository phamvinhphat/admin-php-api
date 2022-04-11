<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Repository\IRoleRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class RoleController extends Controller
{
    private IRoleRepository $iRoleRepository;

    public function __construct(IRoleRepository $iRoleRepository)
    {
        $this->iRoleRepository = $iRoleRepository;
        $this->middleware('auth:api');
    }

    public function getAllRole(){
        return $this->iRoleRepository->getAllRole();
    }

    public function getMyRole()
    {
        return $this->iRoleRepository->getMyRole(Auth::id());
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

        return $this->iRoleRepository->createRole($DB);
    }
    public function deleteRole(Request $request)
    {
        $id = $request->route('id');
        return $this->iRoleRepository->deleteRole($id);
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

        return $this->iRoleRepository->updateRole($id,$DB);
    }
}
