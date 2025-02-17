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
        if ($record) {
            $record->update($data);
        }
        return $record;
    }

    public function delete(int $id)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->delete();
            return true;
        }
    }
}
