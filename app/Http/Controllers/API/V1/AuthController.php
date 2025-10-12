<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {
    }

    public function register(UserRegistrationRequest $request)
    {
        return $this->service->register($request->validated());
    }
}
