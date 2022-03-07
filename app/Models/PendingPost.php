<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingPost extends Model
{
    use HasFactory;

    public $timestamps = false;

//    protected $fillable = [
//        'contents',
//        'furnitureStatus',
//        'address',
//    ];

    protected $casts = [
        'id' => 'string',
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


    protected $primaryKey = 'id';

    protected $table = 'PendingPost';

    public function pendingPost()
    {
        return $this->hasMany(Workflow::class, 'pendingPost_id');
    }


}
