<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'isBlocked' => false
    ];

    protected $casts= [
        'account_id' => 'string',
        'thread_id' => 'string',
        'is_blocked' => 'boolean'
    ];

    protected $attributes = [
      'is_blocked' => false
    ];

    public $timestamps = true;

    protected $primaryKey = array('account_id','thead_id');

    protected $table = 'Member';

}
