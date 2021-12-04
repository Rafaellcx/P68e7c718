<?php

namespace App\Services;

use App\Http\Resources\MissionResource;
use App\Repositories\MissionRepository;

class MissionService
{

    public function __construct(MissionRepository $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function findById($id)
    {
        $mission = $this->missionRepository->findById($id);
        if (empty($mission)) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        return response()->json(new MissionResource($mission));

    }

    public function save($request)
    {
        $mission = $this->missionRepository->save($request);

        return response()->json(new MissionResource($mission), 201);
    }
}
