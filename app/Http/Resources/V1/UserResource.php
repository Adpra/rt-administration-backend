<?php

namespace App\Http\Resources\V1;

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
        /** @var \App\Models\User $user */

        $user = $this;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'is_admin' => $user->is_admin,
            'image' => $user->image,
            'created_at' => $user->created_at?->format('d-m-Y H:i:s'),
            'updated_at' => $user->updated_at?->format('d-m-Y H:i:s'),
        ];
    }
}
