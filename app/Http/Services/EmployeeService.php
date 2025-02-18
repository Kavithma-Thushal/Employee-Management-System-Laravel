<?php

namespace App\Http\Services;

use App\Repositories\Employee\EmployeeRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EmployeeService
{
    protected EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function create(array $data)
    {
        try {
            return $this->employeeRepositoryInterface->create($data);
        } catch (HttpException $e) {
            return $e->getMessage();
        }
    }

    public function update(array $data, int $id)
    {
        try {
            return $this->employeeRepositoryInterface->update($data, $id);
        } catch (HttpException $e) {
            return $e->getMessage();
        }
    }

    public function delete(int $id)
    {
        try {
            return $this->employeeRepositoryInterface->delete($id);
        } catch (HttpException $e) {
            return $e->getMessage();
        }
    }

    public function getById(int $id)
    {
        try {
            return $this->employeeRepositoryInterface->find($id);
        } catch (HttpException $e) {
            return $e->getMessage();
        }
    }

    public function getAll()
    {
        try {
            return $this->employeeRepositoryInterface->findAll();
        } catch (HttpException $e) {
            return $e->getMessage();
        }
    }
}
