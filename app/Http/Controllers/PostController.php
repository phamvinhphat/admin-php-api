<?php

namespace App\Http\Controllers;

use App\Repository\Post\PostInterface;
use App\Repository\Post\PostRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getListPost(){
        try{
            $post = $this->postRepository->getListPost();
            return response()->json($post);
        }catch (\AppException $e){
            return $this->respondError($e->getMessage());
        }
    }


}
