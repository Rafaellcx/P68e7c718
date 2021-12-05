<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    public function __construct(UserRepository $userRepository)
    {
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
        return $this->userRepository->save($request);
    }
}
