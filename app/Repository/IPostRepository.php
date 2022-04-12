<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface IPostRepository
{

    public function createPost($id);
}
