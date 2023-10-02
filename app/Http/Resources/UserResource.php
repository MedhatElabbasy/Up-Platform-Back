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
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => [
                'email'         => $this->email,
                'verified'      => (is_null($this->email_verified_at)) ? false : true,
                'verified_date' => (is_null($this->email_verified_at)) ? null : $this->email_verified_at->format('Y-m-d')
            ],
            'phone' => $this->phone,
        ];
    }
}
