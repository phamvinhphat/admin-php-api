<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface IPostIRepository extends IRepository
{

    /**
     * List Post
     * @return array
     * @throws ModelNotFoundException
     */
    public function getListPost();


}
