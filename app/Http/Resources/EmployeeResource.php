<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
