<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\CrudRepository;

class EmployeeRepository extends CrudRepository implements EmployeeRepositoryInterface
{
    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }

    public function getByAddress(string $address)
    {
        return $this->model->where('address', $address)->get();
    }

    public function test()
    {
        $data = [1, 2, 3, 4, 5];
        return $data;
    }
}
