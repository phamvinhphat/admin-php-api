<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $casts = [
        'id' => 'string',
        'document_code' => 'string',
        'data' => 'json',
        'is_workflow' => 'boolean',
        'is_auth' => 'boolean',
        'is_register' => 'real',
    ];


    protected $primaryKey = 'id';

    protected $table = 'document';

    public function document()
    {
        return $this->hasMany(workflow::class, 'document_id');
    }
}
