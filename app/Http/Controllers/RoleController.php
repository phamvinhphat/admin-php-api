<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IRoleRepository;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    private IRoleRepository $iRoleRepository;

    public function __construct(IRoleRepository $iRoleRepository)
    {
        $this->iRoleRepository = $iRoleRepository;
    }

    public function getAllRole(){
        $dataRole = $this->iRoleRepository->getAllRole();

        return response()->json([
           'data'=>$dataRole
        ]);
    }


}
