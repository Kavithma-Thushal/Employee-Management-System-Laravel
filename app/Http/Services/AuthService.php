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
            $this->userRepositoryInterface->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function login(array $data)
    {
        // Check Email
        $email = $this->userRepositoryInterface->findByEmail($data['email']);
        if (!$email) {
            throw new HttpException(HttpStatus::UNPROCESSABLE_CONTENT, 'Username or password invalid!');
        }

        // Check Password
        $password = Hash::check($data['password'], $email->password);
        if (!$password) {
            throw new HttpException(HttpStatus::UNPROCESSABLE_CONTENT, 'Username or password invalid!');
        }

        // Return Token
        $token = $email->createToken('ems')->accessToken;
        if ($token == null) {
            throw new HttpException(HttpStatus::INTERNAL_SERVER_ERROR, 'Token generate failed!');
        }

        return $token;

    }
}
