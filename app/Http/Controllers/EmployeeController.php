<?php

namespace App\Http\Controllers;

use App\Classes\ErrorResponse;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\SuccessResource;
use App\Http\Services\EmployeeService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function create(EmployeeRequest $request)
    {
        try {
            $employeeData = $this->employeeService->create($request->validated());
            return new SuccessResource([
                'message' => 'Employee saved successfully!',
                'data' => new EmployeeResource($employeeData)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function update(EmployeeRequest $request, int $id)
    {
        try {
            $employeeData = $this->employeeService->update($request->validated(), $id);
            return new SuccessResource([
                'message' => 'Employee updated successfully!',
                'data' => new EmployeeResource($employeeData)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->employeeService->delete($id);
            return new SuccessResource(['message' => 'Employee deleted successfully!']);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function getById(int $id)
    {
        try {
            $employeeData = $this->employeeService->getById($id);
            return new SuccessResource(['data' => new EmployeeResource($employeeData)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function getAll()
    {
        try {
            $employeeData = $this->employeeService->getAll();
            return new SuccessResource(['data' => EmployeeResource::collection($employeeData)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function getByAddress(string $address)
    {
        try {
            $employeeData = $this->employeeService->getByAddress($address);
            return new SuccessResource(['data' => EmployeeResource::collection($employeeData)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function getByEmail(string $email)
    {
        try {
            $employeeData = $this->employeeService->getByEmail($email);
            return new SuccessResource(['data' => EmployeeResource::collection($employeeData)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }

    public function test()
    {
        try {
            $testData = $this->employeeService->test();
            return new SuccessResource(['message' => 'Tested Successfully!', 'data' => $testData]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }
}
