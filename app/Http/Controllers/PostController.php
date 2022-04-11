<?php

namespace App\Http\Controllers;
use App\Repository\IPostRepository;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private IPostRepository $iPostRepository;

    public function __construct(IPostRepository $iPostRepository)
    {
        $this->iPostRepository = $iPostRepository;
        $this->middleware('auth:api');
    }



    /**
     * @return array
     */
    public function getViewPost()
    {
        return $this->iPostRepository->getListPost();
    }



}
