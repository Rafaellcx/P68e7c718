<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
class UserRepository
{
    public function findById($id)
    {
        $user = User::find($id);

        return $user;
    }

    public function save($request)
    {
        $user = new User();
        $user->type_user_id = $request->type_user_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }
}
