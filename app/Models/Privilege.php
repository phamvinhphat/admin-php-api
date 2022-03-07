<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    public $timestamps = false;

//    protected $fillable = [
//        'name'
//    ];

    protected $primaryKey = 'id';

    protected $table = 'Privilege';

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'parent_n' => 'string',
    ];

    public function account()
    {
        return $this->hasMany(account::class,'privilege_id','privilege_id');
    }

    public function privilege()
    {
        return $this->hasMany(privilege::class, 'parent_n','parent_n');
    }
    public function childPrivilege()
    {
        return $this->hasMany(privilege::class, 'parent_n')->with('Privilege');
    }
}
