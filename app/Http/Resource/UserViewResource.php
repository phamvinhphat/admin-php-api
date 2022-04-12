<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class UserViewResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'id_card' => $this->id_card,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'email' => $this->email,
            'avatar' => $this->avatar,
        ];
    }

}
