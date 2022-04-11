<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Models\role;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
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
        return response()->json(["result" => DB::table('role')->get()],ResponseAlias::HTTP_OK);
    }

    public function getMyRole($id)
    {
        $idRole = DB::table('account')->where('id', $id)->value('role_id');
        $nameRole = DB::table('role')->where('id', $idRole)->get('name');
        return response()->json([
            "result" => $nameRole
        ],ResponseAlias::HTTP_OK);
    }
}
