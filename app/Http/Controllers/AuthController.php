<?php

namespace App\Http\Controllers;

use App\Classes\ErrorResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Services\AuthService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->authService->register($request->validated());
            return new SuccessResource(['message' => 'User registered successfully!']);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request->validated());
            return new SuccessResource(['message' => 'User logged in successfully!', 'token' => $token]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }
}
