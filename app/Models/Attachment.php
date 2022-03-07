<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'id'=>'string',
        'uri'=>'string',
        'caption'=>'string',
        'message_id' => 'string'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Attachment';
}
