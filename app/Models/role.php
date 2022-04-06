<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    public $timestamps = false;

//    protected $fillable = [
//        'name'
//    ];

    protected $primaryKey = 'id';

    protected $table = 'role';

    protected $casts = [
        'id' => 'string',
        'role' => 'string',
    ];

    public function account()
    {
        return $this->hasMany(account::class,'privilege_id','privilege_id');
    }

    public function permissons(){
        return $this->belongsToMany(permission::class);
    }


}
