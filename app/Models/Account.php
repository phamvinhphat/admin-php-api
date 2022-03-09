<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Illuminate\Support\Facades\Hash;

class Account extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'dob',
        'is_card',
        'phone_number',
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Account';

    protected $casts = [
        'id' => 'string',
        'username ' => 'string',
        'password'=> 'string',
        'first_name'=> 'string',
        'last_name' => 'string',
        'Dob' => 'date',
        'id_card' => 'string',
        'avatar'=> 'string',
        'gender'=> 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'privilege_id'=> 'string',
        'is_verity' =>'boolean',
    ];

    protected $attributes = [
        'isVerity' => false,
    ];
    public function privilege(){
        return $this->belongsTo(Privilege::class,'privilege_id');
    }

    public function workflow(){
        return $this->hasMany(Workflow::class,'created_by');
    }

    public function message(){
        return $this->hasMany(Message::class,'sender_id');
    }

    public function conversation(){
        return $this->belongsToMany(Conversation::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function pendingPost(){
        return $this->hasMany(PendingPost::class,'created_by');
    }

    public function register(array $attributes){
        $account = new self();
        $account->username = $attributes["username"];
        $account->email = $attributes["email"];
        $account->password = Hash::make($attributes["password"]);
        $account->first_name = $attributes["first_name"];
        $account->last_name = $attributes["last_name"];
        $account->dob = $attributes["dob"];
        $account->id_card = $attributes["id_cart"];
        $account->phone_number = $attributes["phone_number"];
        $account->save();
        return $account;
    }

    public function getsUser(){
        $users = $this::all();
        return $users;
    }

}
