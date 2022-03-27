<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
            'id' => 'string',
        ];

    protected $primaryKey = 'id';

    protected $table = 'conversation';

    public function account(){
        return $this->belongsToMany(account::class);
    }

    public function message(){
        return $this->hasMany(message::class,'conversation_id');
    }

}
