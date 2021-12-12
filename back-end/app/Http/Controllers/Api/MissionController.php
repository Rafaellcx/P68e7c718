<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use App\Http\Requests\FinishMissionRequest;
use App\Models\Mission;
use App\Services\MissionService;
use App\Http\Resources\MissionResource;
class MissionController extends Controller
{
    public function __construct(MissionService $missionService)
    {
        $this->missionService = $missionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->missionService->findAll();

    }
   
    public function findMostRecent()
    {
        return $this->missionService->findMostRecent();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->missionService->findById($id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMissionRequest $request)
    {
        $mission = $this->missionService->save($request);
        
        return response()->json(new MissionResource($mission), 201);

    }
    public function finish(FinishMissionRequest $request)
    {
       return $this->missionService->finish($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->missionService->delete($id);

    }
}
