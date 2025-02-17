<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class CrudRepository implements CrudRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
