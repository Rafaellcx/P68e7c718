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
        return $this->missionRepository->save($request);
    }

    public function delete($id)
    {
        $mission = $this->missionRepository->findById($id);
        if (empty($mission)) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        $mission = $this->missionRepository->delete($id);
        return response()->noContent();

    }
}
