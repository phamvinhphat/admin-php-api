<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'ID';

    protected $table = 'Post';


    protected $casts = [
        'ID' => 'string',
        'longitude' => 'double',
        'latitude' => 'double',
        'contents' => 'string',
        'price' => 'double',
        'floor_area' => 'real',
        'address' => 'string',
        'furniture_status' => 'string',
        'album_id' => 'string',
        'create_by' => 'string',
    ];

    protected $fillable = [
        'contents',
        'furniture_status',
        'address',
    ];

    public function Comment()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }


}
