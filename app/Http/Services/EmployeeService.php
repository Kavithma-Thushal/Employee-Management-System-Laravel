<?php

namespace App\Http\Services;

use App\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeService
{
    protected EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function create(array $data)
    {
        return $this->employeeRepositoryInterface->create($data);
    }

    public function update()
    {
        return 'Employee Update';
    }

    public function delete()
    {
        return 'Employee Delete';
    }

    public function getById()
    {
        return 'Employee Get By Id';
    }

    public function getAll()
    {
        return 'Employee Get All';
    }
}
