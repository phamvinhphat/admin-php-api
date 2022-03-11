<?php

namespace App\Repository\Post;

use App\Models\Post;
use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class PostRepository extends BaseRepository implements PostInterface
{

    public function model(): string
    {
        return Post::class;
    }

    #[Pure] public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getListPost(): array
    {
        /** @var Post $user */
        $post = $this
            ->newQuery()
            ->select(
                'id',
                'contents',
                'longitude',
                'latitude',
                'price',
                'floor_area',
                'address',
                'furniture_status',
                'created_by',
                'album_id',
                'created_at',
                'updated_at')
            ->get();

        return $post;

    }
}
