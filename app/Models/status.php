<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'parent_n' => 'string',
    ];

    protected $table = 'status';

    public function status()
    {
        return $this->hasMany(status::class, 'paren_n');
    }

    public function workflow(){
        return $this->hasMany(workflow::class, 'status_id');
    }

}
