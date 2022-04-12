<?php

namespace App\Http\Controllers;
use App\Repository\IPostRepository;
use Illuminate\Http\JsonResponse;

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
    public function getViewPost()
    {
        return $this->postRepository->getListPost();
    }



}
