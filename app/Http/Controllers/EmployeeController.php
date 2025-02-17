<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function create(EmployeeRequest $request)
    {
        $data = $this->employeeService->create($request->validated());
        return ['message' => 'Employee saved successfully...!',
            'Employee Data' => new EmployeeResource($data)];
    }

    public function update(EmployeeRequest $request, int $id)
    {
        $data = $this->employeeService->update($request->validated(), $id);
        return ['message' => 'Employee updated successfully...!',
            'Employee Data' => new EmployeeResource($data)];
    }

    public function delete(int $id)
    {
        $this->employeeService->delete($id);
        return ['message' => 'Employee deleted successfully...!'];
    }

    public function getById(int $id)
    {
        $data = $this->employeeService->getById($id);
        return ['Employee Data' => new EmployeeResource($data)];
    }

    public function getAll()
    {
        $data = $this->employeeService->getAll();
        return ['Employee Data' => EmployeeResource::collection($data)];
    }
}
