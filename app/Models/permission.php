<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $table = 'permission';

    protected $casts = [
        'id' => 'string',
        'permission_title' => 'string',
    ];

    public function roles()
    {
        return $this->belongsToMany(role::class);
    }

}
