<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'ID' => 'string',
        'contents' => 'string',
        'parent_n' => 'string',
        'album_id' => 'string',
        'post_id' => 'string',
    ];


    protected $table = 'Album';

    public function comment()
    {
        return $this->hasMany(Comment::class,'album_id');
    }

    public function post(){
        return $this->hasMany(Post::class,'album_id');
    }

    public function image(){
        return $this->hasMany(Image::class,'album_id');
    }

    public function pendingPost()
    {
        return $this->hasMany(PendingPost::class,'album_id');
    }

}
