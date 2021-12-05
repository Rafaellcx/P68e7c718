<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\AuthenticateService;
use App\Http\Requests\LoginRequest;

class AuthenticateController extends Controller
{
    public function __construct(AuthenticateService $authenticateService)
    {
        $this->authenticateService = $authenticateService;
    }

    public function login(LoginRequest $request)
    {
        return $this->authenticateService->login($request);
    }
}
