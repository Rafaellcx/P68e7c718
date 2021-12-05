<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
class AuthenticateRepository
{
    public function getUserData($request)
    {
        return User::where('email', '=', $request->email)->first();
    }
}