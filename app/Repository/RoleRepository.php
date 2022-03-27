<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Models\role;
use function GuzzleHttp\Promise\all;

class RoleRepository implements IRoleRepository
{

    /**
     * get view role all
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getAllRole()
    {
        return role::all();
    }
}
