<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class account extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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
//        'first_name',
//        'last_name',
//        'is_card',
//        'phone_number',
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account';

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
        'saved_posts'=>'string',
        'recently_viewed_posts'=> 'string',
        'phone_number' => 'string',
        'privilege_id'=> 'string',
        'is_admin' => 'boolean',
        'is_verity' =>'boolean',
    ];

    protected $attributes = [
        'isVerity' => false,
    ];
    public function privilege(){
        return $this->belongsTo(role::class,'privilege_id');
    }

    public function workflow(){
        return $this->hasMany(workflow::class,'created_by');
    }

    public function message(){
        return $this->hasMany(message::class,'sender_id');
    }

    public function conversation(){
        return $this->belongsToMany(conversation::class);
    }

    public function post()
    {
        return $this->hasMany(post::class, 'created_by');
    }

    public function pendingPost(){
        return $this->hasMany(pending_post::class,'created_by');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

}
