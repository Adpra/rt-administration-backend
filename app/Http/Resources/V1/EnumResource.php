<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Enum $enum */

        $enum = $this;

        return [
            'id' => $enum->id,
            'name' => $enum->name,
            'key' => $enum->key,
            'value' => $enum->value,
            'type' => $enum->type,
        ];
    }
}
