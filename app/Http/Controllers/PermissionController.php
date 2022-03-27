<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IPermissionRepository;
class PermissionController extends Controller
{
    private IPermissionRepository $iPermissionRepository;

    public function __construct( IPermissionRepository $iPermissionRepository)
    {
        $this->iPermissionRepository = $iPermissionRepository;
    }

    public function getAllPermission(){
        return response()->json([
           'data'=>$this->iPermissionRepository->getAllPermission()
        ]);
    }

}
