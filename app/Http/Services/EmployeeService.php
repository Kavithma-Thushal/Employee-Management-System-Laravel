<?php

namespace App\Http\Services;

use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
            $data = $this->employeeRepositoryInterface->create($data);
            DB::commit();
            return $data;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepositoryInterface->find($id);
            if (!$employee) {
                throw new HttpException(404, 'Employee not found!');
            }
            $data = $this->employeeRepositoryInterface->update($data, $id);
            DB::commit();
            return $data;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepositoryInterface->find($id);
            if (!$employee) {
                throw new HttpException(404, 'Employee not found!');
            }
            $data = $this->employeeRepositoryInterface->delete($id);
            DB::commit();
            return $data;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById(int $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->employeeRepositoryInterface->find($id);
            DB::commit();
            return $data;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getAll()
    {
        DB::beginTransaction();
        try {
            $data = $this->employeeRepositoryInterface->findAll();
            DB::commit();
            return $data;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
