<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
            'id' => 'string',
        ];

    protected $primaryKey = 'id';

    protected $table = 'Conversation';

    public function member(){
        return $this->belongsToMany(Account::class);
    }

    public function message(){
        return $this->hasMany(Message::class,'conversation_id');
    }

}
