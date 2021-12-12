<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLogCommandMissionRequest;
use App\Http\Requests\UpdateLogCommandMissionRequest;
use App\Models\LogCommandMission;
use App\Services\LogCommandMissionService;
use Illuminate\Http\Request;
use App\Http\Resources\LogCommandMissionResource;

class LogCommandMissionController extends Controller
{
    public function __construct(LogCommandMissionService $logCommandMissionService)
    {
        $this->logCommandMissionService = $logCommandMissionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findCommandsByMission($missionId)
    {
        return $this->logCommandMissionService->findCommandsByMission($missionId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLogCommandMissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogCommandMissionRequest $request)
    {
        $logCommandMission = $this->logCommandMissionService->save($request);

        return response()->json(new LogCommandMissionResource($logCommandMission), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogCommandMission  $logCommandMission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->logCommandMissionService->findById($id);
    }
}
