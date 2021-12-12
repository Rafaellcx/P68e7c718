<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTypeUserRequest;
use App\Http\Requests\UpdateTypeUserRequest;
use App\Models\TypeUser;
use App\Http\Controllers\Controller;
use App\Services\TypeUserService;

class TypeUserController extends Controller
{
    public function __construct(TypeUserService $typeUserService)
    {
        $this->typeUserService = $typeUserService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->typeUserService->findAll();
    }

}
