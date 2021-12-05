<?php

namespace App\Services;

use App\Repositories\LogCommandMissionRepository;
use App\Http\Resources\LogCommandMissionResource;

class LogCommandMissionService
{

    public function __construct(LogCommandMissionRepository $logCommandMissionRepository)
    {
        $this->logCommandMissionRepository = $logCommandMissionRepository;
    }

    public function findById($id)
    {
        $logCommandMission = $this->logCommandMissionRepository->findById($id);
        if (empty($logCommandMission)) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        return response()->json(new LogCommandMissionResource($logCommandMission), 200);

    }

    public function findCommandsByMission($missionId)
    {
        $logsCommandsMission = $this->logCommandMissionRepository->findCommandsByMission($missionId);
        if (count($logsCommandsMission) == 0) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        return response()->json(LogCommandMissionResource::collection($logsCommandsMission), 200);

    }

    public function save($request)
    {
        return $this->logCommandMissionRepository->save($request);
    }
}
