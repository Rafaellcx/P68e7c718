<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogCommandMissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'mission_id' => $this->mission_id,
            'mission' => $this->mission->name,
            'user_id' => $this->user_id,
            'user' => $this->user->name,
            'isAdmin' => $this->user->typeuser->isAdmin,
            'typeUserName' => $this->user->typeuser->name,
            'created_at' => $this->created_at_log_mission
        ];

    }
}
