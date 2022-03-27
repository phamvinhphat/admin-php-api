<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'id' => 'string',
        'contents' => 'string',
        'parent_n' => 'string',
        'album_id' => 'string',
        'post_id' => 'string',
    ];


    protected $table = 'album';

    public function comment()
    {
        return $this->hasMany(comment::class,'album_id');
    }

    public function post(){
        return $this->hasMany(post::class,'album_id');
    }

    public function image(){
        return $this->hasMany(image::class,'album_id');
    }

}
