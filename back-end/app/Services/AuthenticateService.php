<?php

namespace App\Services;

use App\Http\Resources\AuthenticateResource;
use App\Repositories\AuthenticateRepository;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;

class AuthenticateService
{
    public function __construct(AuthenticateRepository $authenticateRepository)
    {
        $this->authenticateRepository = $authenticateRepository;
    }

    public function login($request)
    {
        $userData = $this->authenticateRepository->getUserData($request);

        if (isset($userData)) {
            if (Hash::check($request->password, $userData["password"])) {
                $accessToken = $this->geraToken($userData["id"], $userData["email"]);

                return response()->json(['user' => new AuthenticateResource($userData), 'accessToken' => $accessToken], 200);
            } else {
                return response()->json(['error' => 'Dados inválidos.'], 404);
            }
        }

        return response()->json(['error' => 'Nenhum registro encontrado.'], 404);
    }

    public function geraToken($id, $email)
    {
        $payload = JWTFactory::emptyClaims()->addClaims([
            'sub' => ['email' => $email, 'id' => $id],
        ])->make();

        return JWTAuth::encode($payload)->__toString();
    }
}
