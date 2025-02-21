<?php

namespace App\Repositories\User;

use App\Repositories\CrudRepositoryInterface;

interface UserRepositoryInterface extends CrudRepositoryInterface
{
    public function findByEmail(string $email);
}
