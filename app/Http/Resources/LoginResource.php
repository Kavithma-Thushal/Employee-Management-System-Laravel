<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => new UserResource($this['user']),
            'access_token' => $this['access_token']
        ];
    }
}
