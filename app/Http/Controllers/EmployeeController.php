<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Services\EmployeeService;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            $data = $this->employeeService->create($request->validated());
            return ['message' => 'Employee saved successfully!',
                'data' => new EmployeeResource($data)];
        } catch (HttpException $e) {
            return ['message' => $e->getMessage()];
        }
    }

    public function update(EmployeeRequest $request, int $id)
    {
        try {
            $data = $this->employeeService->update($request->validated(), $id);
            return ['message' => 'Employee updated successfully!',
                'data' => new EmployeeResource($data)];
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(["error" => $e->getMessage()], $e->getStatusCode()));
        }
    }

    public function delete(int $id)
    {
        try {
            $this->employeeService->delete($id);
            return ['message' => 'Employee deleted successfully!'];
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(["error" => $e->getMessage()], $e->getStatusCode()));
        }
    }

    public function getById(int $id)
    {
        try {
            $data = $this->employeeService->getById($id);
            return ['data' => new EmployeeResource($data)];
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(["error" => $e->getMessage()], $e->getStatusCode()));
        }
    }

    public function getAll()
    {
        try {
            $data = $this->employeeService->getAll();
            return ['data' => EmployeeResource::collection($data)];
        } catch (HttpException $e) {
            return ['message' => $e->getMessage()];
        }
    }

    public function getByAddress(string $address)
    {
        try {
            $data = $this->employeeService->getByAddress($address);
            return ['data' => EmployeeResource::collection($data)];
        } catch (HttpException $e) {
            return ['message' => $e->getMessage()];
        }
    }
}
