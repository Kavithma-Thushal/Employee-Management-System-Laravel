<?php

namespace App\Http\Controllers;

use App\Classes\ErrorResponse;
use App\Http\Requests\UserRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UserRequest $request, int $id)
    {
        try {
            $data = $this->userService->update($request->all(), $id);
            return new SuccessResource([
                'message' => 'User updated successfully!',
                'data' => new UserResource($data)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }
}
