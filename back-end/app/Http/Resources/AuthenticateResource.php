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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'typeUser' => $this->typeUser->name,
        ];

    }
}
