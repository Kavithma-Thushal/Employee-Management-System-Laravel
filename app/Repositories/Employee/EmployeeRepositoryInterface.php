<?php

namespace App\Repositories\Employee;

use App\Repositories\CrudRepositoryInterface;

interface EmployeeRepositoryInterface extends CrudRepositoryInterface
{
    public function getByAddress(string $address);

    public function getByEmail(string $email);

    public function test();
}
