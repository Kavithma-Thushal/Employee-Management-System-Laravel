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

    public function update(array $data, int $id)
    {
        $record = $this->model->find($id);
        $record->update($data);
        return $record;
    }

    public function delete(int $id)
    {
        $this->model->find($id)->delete();
    }

    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
