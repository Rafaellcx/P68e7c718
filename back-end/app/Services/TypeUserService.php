<?php

namespace App\Services;

use App\Http\Resources\TypeUserResource;
use App\Repositories\TypeUserRepository;

class TypeUserService
{

    public function __construct(TypeUserRepository $typeUserRepository)
    {
        $this->typeUserRepository = $typeUserRepository;
    }

    public function findAll()
    {
        $typeUser = $this->typeUserRepository->findAll();

        if (count($typeUser) == 0) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        return response()->json(TypeUserResource::collection($typeUser));

    }
}