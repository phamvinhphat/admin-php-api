<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $table = 'post';


    protected $casts = [
        'id' => 'string',
        'longitude' => 'double',
        'latitude' => 'double',
        'contents' => 'string',
        'price' => 'double',
        'floor_area' => 'real',
        'address' => 'string',
        'furniture_status' => 'string',
        'views'=>'integer',
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
        return $this->hasMany(comment::class, 'post_id');
    }


}
