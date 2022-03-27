<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'message'
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'id'=>'string',
        'message'=>'string',
        'reply_to' => 'string',
        'conversation_id' => 'string',
        'sender_id' => 'string',

    ];

    protected $table = 'message';

    public function message(){
        return $this->hasMany(message::class, 'sender_id');
    }

    public function attachment(){
        return $this->hasMany(attachment::class, 'message_id');
    }


}
