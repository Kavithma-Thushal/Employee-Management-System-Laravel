<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function create(EmployeeRequest $request)
    {
        $data = $this->employeeService->create($request->all());
        return ['message' => 'Employee saved successfully...!',
            'Employee Data' => new EmployeeResource($data)];
    }

    public function update()
    {
        return $this->employeeService->update();
    }

    public function delete()
    {
        return $this->employeeService->delete();
    }

    public function getById()
    {
        return $this->employeeService->getById();
    }

    public function getAll()
    {
        return $this->employeeService->getAll();
    }
}
