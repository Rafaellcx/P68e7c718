<?php

namespace App\Repositories;

use App\Models\LogCommandMission;

class LogCommandMissionRepository
{
    public function findById($id)
    {
        $logCommandMission = LogCommandMission::find($id);

        return $logCommandMission;
    }

    public function findCommandsByMission($mission_id)
    {
        $logCommandMission = LogCommandMission::where('mission_id', '=', $mission_id)->orderBy('updated_at', 'desc')->get();

        return $logCommandMission;
    }

    public function save($request)
    {
        $logCommandMission = new LogCommandMission();
        $logCommandMission->description = $request->description;
        $logCommandMission->mission_id = $request->mission_id;
        $logCommandMission->user_id = $request->user_id;
        $logCommandMission->save();

        return $logCommandMission;
    }
}
