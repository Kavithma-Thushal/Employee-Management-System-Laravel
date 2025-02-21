<?php

namespace App\Http\Services;

use App\Repositories\Staff\StaffRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StaffService
{
    protected StaffRepositoryInterface $staffRepositoryInterface;

    public function __construct(StaffRepositoryInterface $staffRepositoryInterface)
    {
        $this->staffRepositoryInterface = $staffRepositoryInterface;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $this->staffRepositoryInterface->create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById(int $id)
    {
        return $this->staffRepositoryInterface->find($id);
    }
}
