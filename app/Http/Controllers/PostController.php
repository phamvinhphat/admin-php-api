<?php

namespace App\Http\Controllers;
use App\Repository\IPostIRepository;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private IPostIRepository $IPostRepository;

    public function __construct(IPostIRepository $IPostRepository)
    {
        $this->IPostRepository = $IPostRepository;
    }


    public function getViewPost(): JsonResponse
    {
        return response()->json([
            'data' => $this->IPostRepository->getListPost()
        ]);
    }



}
