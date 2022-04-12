<?php

namespace App\Repository;

use App\Models\post;
use App\service\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostRepository implements IPostRepository
{

    private IUserRepository $userRepository;
    private IDocumentRepository $documentRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository,IDocumentRepository $documentRepository,PermissionService $permissionService)
    {
        $this->userRepository = $iUserRepository;
        $this->documentRepository = $documentRepository;
        $this->permissionService = $permissionService;
    }

    public function createPost($id)
    {
         $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"post","create");
        if($isAdmin == true || $isRole == true) {
            $dataPost = DB::table('document')
                ->where('id', '=', $id)
                ->value('data');
            $data = json_decode($dataPost, true);
            $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

            $database = array(
                'id' => $data['id'],
                'contents' => $data['contents'],
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
                'price' => $data['price'],
                'floor_area' => $data['floor_area'],
                'document_id' => $id,
                'furniture_status' => $data['furniture_status'],
                'views' => $data['views'],
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
                'created_by_id' => $data['created_by_id'],
                'modified_by_id' => $data['modified_by_id'],
            );

            $create = DB::table('post')->insert($database);
            return response()->json(["json" => $create]);
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }
    }
}
