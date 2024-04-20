<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "username" => $this->username,
            "name" => $this->name,
            $this->mergeWhen($request->user()?->isAdmin(), [
                'email' => $this->email,
                'admin' => $this->isAdmin(),
            ]),
            "email_verified_at" => $this->email_verified_at,
            "permissions" => $this->when($this->relationLoaded("permissions"), $this->permissions->pluck("name")->toArray()),
        ];
    }
}
