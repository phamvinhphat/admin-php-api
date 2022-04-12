<?php

namespace App\Http\Controllers;
use App\Repository\IPostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private IPostRepository $postRepository;

    public function __construct(IPostRepository $iPostRepository)
    {
        $this->postRepository = $iPostRepository;
        $this->middleware('auth:api');
    }



    /**
     * @return array
     */
    public function createPost(Request $request)
    {
        $id = $request->route('id');
        return $this->postRepository->createPost($id);
    }
}
