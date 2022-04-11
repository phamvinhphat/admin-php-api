<?php

namespace App\Repository;

use App\Models\post;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Pure;

use Illuminate\Support\Facades\DB;
class PostRepository implements IPostRepository
{

    /**
     * @return JsonResponse
     */
    public function getListPost(): JsonResponse
    {
        $post = DB::table('post')
            ->get([
                'contents',
                'longitude',
                'latitude',
                'price',
                'floor_area',
                'address',
                'furniture_status',
                'created_by_id',
                'modified_by_id',
                'album_id',
                'created_at',
                'updated_at']);

        return response()->json([
            "result" => $post
        ]);

    }


}
