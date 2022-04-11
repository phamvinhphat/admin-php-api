<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IRoleRepository;
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
}
