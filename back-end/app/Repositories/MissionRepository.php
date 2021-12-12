<?php

namespace App\Repositories;

use App\Models\Mission;

class MissionRepository
{
    public function findAll()
    {
        $missions = Mission::All();

        return $missions;
    }
    
    public function findById($id)
    {
        $mission = Mission::find($id);

        return $mission;
    }
    
    public function findMostRecent()
    {
        $mission = Mission::where('has_finished', false)->orderBy('updated_at', 'desc')->first();
        
        return $mission;
    }

    public function save($request)
    {
        $mission = new Mission();
        $mission->user_id = $request->user_id;
        $mission->name = $request->name;
        $mission->has_finished = false;
        $mission->save();

        return $mission;
    }

    public function finish($request)
    {
        $mission = Mission::where('id', '=', $request->id)->update(['has_finished' => true]);
        return $mission;
    }
    public function delete($id)
    {
        return Mission::where('id', $id)->delete();

    }
}
