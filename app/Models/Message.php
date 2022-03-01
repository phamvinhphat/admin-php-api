<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'message'
    ];

    protected $primaryKey = 'ID';

    protected $casts = [
        'ID'=>'string',
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
