<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    public $timestamps = true;


    protected $casts = [
        'ID' => 'string',
        'status_id' => 'string',
        'pending_post_id' => 'string',
        'create_by' => 'string'
    ];

    protected $primaryKey = 'ID';

    protected $table = 'Workflow';
}
