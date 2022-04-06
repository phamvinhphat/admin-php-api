<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'url',
        'caption'
    ];

    protected $casts = [
        'id' => 'string',
        'url' => 'string',
        'caption' => 'string',
        'is_hidden' => 'boolean',
        'album_id' => 'string',
    ];

    protected $attributes = [
        'is_hidden' => false,
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image';

}
