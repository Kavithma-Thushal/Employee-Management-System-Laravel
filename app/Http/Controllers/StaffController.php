<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Http\Services\StaffService;

class StaffController
{
    protected StaffService $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function create(StaffRequest $request)
    {
        $this->staffService->create($request->all());
        return ['message' => 'Staff created successfully'];
    }

    public function getById(int $id)
    {
        $data = $this->staffService->getById($id);
        return ['data' => $data];
    }
}
