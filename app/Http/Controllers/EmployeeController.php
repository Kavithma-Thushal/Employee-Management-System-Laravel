<?php

namespace App\Http\Controllers;

use App\Http\Services\EmployeeService;

class EmployeeController extends Controller
{

    public function __construct(private EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return $this->employeeService->index();
    }

    public function create()
    {
        return $this->employeeService->create();
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
