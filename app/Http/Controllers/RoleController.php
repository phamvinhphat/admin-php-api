<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IRoleRepository;
class RoleController extends Controller
{
    private IRoleRepository $iRoleRepository;

    public function __construct(IRoleRepository $iRoleRepository)
    {
        $this->iRoleRepository = $iRoleRepository;
    }

    public function getAllRole(){
        return response()->json([
           'data'=>$this->iRoleRepository->getAllRole()
        ]);
    }


}
