<?php

namespace App\Services;

use App\Http\Resources\MissionResource;
use App\Http\Resources\UserResource;
use App\Repositories\MissionRepository;
use App\Repositories\UserRepository;

class MissionService
{

    public function __construct(MissionRepository $missionRepository, UserRepository $userRepository)
    {
        $this->missionRepository = $missionRepository;
        $this->userRepository = $userRepository;
    }

    public function findAll()
    {
        $mission = $this->missionRepository->findAll();

        if (count($mission) == 0) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        return response()->json(MissionResource::collection($mission));

    }
   
    public function findMostRecent()
    {
        $mission = $this->missionRepository->findMostRecent();

        if (!isset($mission)) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }
        
        return response()->json(new MissionResource($mission));

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

    public function finish($request)
    {
        $user = $this->userRepository->findById($request->user_id);
        
        if (empty($user)) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }
        
        $userResource = new UserResource($user);
        if (!$userResource->typeUser->isAdmin) {
            return response()->json(['error' => 'Apenas usuários administradores podem finalizar uma missão.'], 404);
        }
        
        $mission = $this->missionRepository->finish($request);
        return response()->noContent();
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
