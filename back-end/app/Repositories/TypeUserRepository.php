<?php

namespace App\Repositories;

use App\Models\TypeUser;

class TypeUserRepository
{
    public function findAll()
    {
        $typeUser = TypeUser::All();

        return $typeUser;
    }
}