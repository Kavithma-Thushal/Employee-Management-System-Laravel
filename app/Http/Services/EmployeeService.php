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
            $employeeData = $this->employeeRepositoryInterface->create($data);
            DB::commit();
            return $employeeData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $employeeExist = $this->employeeRepositoryInterface->find($id);
            if (!$employeeExist) {
                throw new HttpException(404, 'Employee not found!');
            }
            $employeeData = $this->employeeRepositoryInterface->update($data, $id);
            DB::commit();
            return $employeeData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $employeeExist = $this->employeeRepositoryInterface->find($id);
            if (!$employeeExist) {
                throw new HttpException(404, 'Employee not found!');
            }
            $employeeData = $this->employeeRepositoryInterface->delete($id);
            DB::commit();
            return $employeeData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById(int $id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepositoryInterface->find($id);
            if (!$employee) {
                throw new HttpException(404, 'Employee not found!');
            }
            DB::commit();
            return $employee;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getAll()
    {
        DB::beginTransaction();
        try {
            $employeeData = $this->employeeRepositoryInterface->findAll();
            DB::commit();
            return $employeeData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getByAddress(string $address)
    {
        DB::beginTransaction();
        try {
            $employeeData = $this->employeeRepositoryInterface->getByAddress($address);
            DB::commit();
            return $employeeData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getByEmail(string $email)
    {
        DB::beginTransaction();
        try {
            $employeeData = $this->employeeRepositoryInterface->getByEmail($email);
            DB::commit();
            return $employeeData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function test()
    {
        DB::beginTransaction();
        try {
            $testData = $this->employeeRepositoryInterface->test();
            DB::commit();
            return $testData;
        } catch (HttpException $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
