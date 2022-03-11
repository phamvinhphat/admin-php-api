<?php

namespace App\Repository\Post;

use App\Models\Post;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface PostInterface extends RepositoryInterface
{

    /**
     * List Post
     * @return array
     * @throws ModelNotFoundException
     */
    public function getListPost(): array;


}
