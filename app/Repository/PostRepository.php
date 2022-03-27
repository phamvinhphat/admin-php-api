<?php

namespace App\Repository;

use App\Models\post;
use JetBrains\PhpStorm\Pure;

class PostRepository extends BaseIRepository implements IPostIRepository
{

    public function model(): string
    {
        return post::class;
    }

    public function __construct(post $model)
    {
        parent::__construct($model);
    }

    public function getListPost(): array
    {
        /** @var post $user */

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

    public function getModel()
    {
        // TODO: Implement getModel() method.
    }
}
