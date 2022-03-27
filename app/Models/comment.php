<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id'=>'string',
        'contents' => 'string',
        'parent_n' => 'string',
        'album_id' => 'string',
        'post_id' => 'string',
    ];

    protected $primaryKey = 'id';

    protected $table = 'comment';

    public function comment(){
        return $this->hasMany(comment::class, 'parent_n');
    }


}
