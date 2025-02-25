<?php

namespace App\Http\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{
    protected UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $userExist = $this->userRepositoryInterface->find($id);
            if (!$userExist) {
                throw new HttpException(404, 'User not found!');
            }
            $data = $this->userRepositoryInterface->update($data, $id);
            DB::commit();
            return $data;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
