<?php

namespace App\Repositories\Staff;

use App\Models\Staff;
use App\Repositories\CrudRepository;

class StaffRepository extends CrudRepository implements StaffRepositoryInterface
{
    public function __construct(Staff $model)
    {
        parent::__construct($model);
    }
}
