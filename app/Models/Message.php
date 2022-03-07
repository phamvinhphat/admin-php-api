<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
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

    protected $table = 'Message';

    public function message(){
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function attachment(){
        return $this->hasMany(Attachment::class, 'message_id');
    }


}
