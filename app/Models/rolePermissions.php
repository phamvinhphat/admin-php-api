<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolePermissions extends Model
{
    use HasFactory;

    protected $casts= [
        'role_id' => 'string',
        'permission_id' => 'string',
    ];

    public $timestamps = false;

    protected $primaryKey = array('role_id', 'permission_id');

    protected $table = 'role_permissions';
}
