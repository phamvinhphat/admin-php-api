<?php

namespace App\Repository;
use App\Models\permission;
class PermissionRepository implements IPermissionRepository
{

    public function getAllPermission()
    {
        return permission::all();
    }
}
