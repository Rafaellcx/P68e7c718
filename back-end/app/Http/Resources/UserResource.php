<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request  = null)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type_user_id' => $this->type_user_id,
            'typeUser' => $this->typeUser->name,
            'isAdmin' => $this->typeUser->isAdmin,
            'created_at' => $this->created_at_user
        ];

    }
}
