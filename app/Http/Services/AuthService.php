<?php

namespace App\Http\Services;

use App\Enums\HttpStatus;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService
{
    protected UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function register(array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepositoryInterface->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function login(array $data)
    {
        // Check Email
        $user = $this->userRepositoryInterface->findByEmail($data['email']);
        if (!$user) throw new HttpException(HttpStatus::UNPROCESSABLE_CONTENT, 'Username or password invalid!');

        // Check Password
        if (!Hash::check($data['password'], $user->password))
            throw new HttpException(HttpStatus::UNPROCESSABLE_CONTENT, 'Username or password invalid!');

        // Create personal access token
        $token = $user->createToken('ems')->accessToken;
        if ($token == null)
            throw new HttpException(HttpStatus::INTERNAL_SERVER_ERROR, 'User authentication failed!');

        return $token;
    }
}
