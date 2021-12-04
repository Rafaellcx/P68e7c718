<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;

class UserService {
  
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function findById($id)
    {
        $user = $this->userRepository->findById($id);
        if (empty($user)) {
            return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
        }

        return response()->json(new UserResource($user));

    }

    public function save($request)
    {
        $user = $this->userRepository->save($request);

        return response()->json(new UserResource($user), 201);
    }
}