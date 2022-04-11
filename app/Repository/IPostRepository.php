<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface IPostRepository
{

    /**
     * List Post
     * @return array
     * @throws ModelNotFoundException
     */
    public function getListPost();


}
