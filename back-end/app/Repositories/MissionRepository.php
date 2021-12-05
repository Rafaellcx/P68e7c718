<?php

namespace App\Repositories;

use App\Models\Mission;

class MissionRepository
{
    public function findById($id)
    {
        $mission = Mission::find($id);

        return $mission;
    }

    public function save($request)
    {
        $mission = new Mission();
        $mission->user_id = $request->user_id;
        $mission->name = $request->name;
        $mission->save();

        return $mission;
    }
    
    public function delete($id)
    {
        return Mission::where('id', $id)->delete();

    }
}
