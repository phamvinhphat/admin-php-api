<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'url',
        'caption'
    ];

    protected $casts = [
        'ID' => 'string',
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
    protected $primaryKey = 'ID';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Image';

}
