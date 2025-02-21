<?php

namespace App\Repositories\Staff;

use App\Repositories\CrudRepositoryInterface;

interface StaffRepositoryInterface extends CrudRepositoryInterface
{
    public function create(array $data);
}
