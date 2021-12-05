<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        return [
            'type_user_id' => $this->type_user_id,
            'typeUser' => $this->typeUser->name,
            'isAdmin' => $this->typeUser->isAdmin,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];

    }
}
