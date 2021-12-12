<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionResource extends JsonResource
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
            'name' => $this->name,
            'user_id' => $this->user_id,
            'user' => $this->user->name,
            'isAdmin' => $this->user->typeuser->isAdmin,
            'typeUserName' => $this->user->typeuser->name,
            'statusMission' => $this->status_mission,
            'created_at' => $this->created_at_mission
        ];

    }
}
