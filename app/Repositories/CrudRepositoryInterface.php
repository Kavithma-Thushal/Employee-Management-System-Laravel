<?php

namespace App\Repositories;
interface CrudRepositoryInterface
{
    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function getById(int $id);

    public function getAll();
}
