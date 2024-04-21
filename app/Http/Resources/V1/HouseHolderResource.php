<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HouseHolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\HouseHolder $houseHolder */

        $houseHolder = $this;

        return [
            'id' => $houseHolder->id,
            'name' => $houseHolder->name,
            'photo_ktp' => $houseHolder->photo_ktp,
            'status_name' => $houseHolder->enum->name,
            'status' => $houseHolder->status,
            'marital_status' => $houseHolder->marital_status,
            'phone' => $houseHolder->phone,
            'house_id' => $houseHolder->house_id,
            'house_name' => $this->house->name,
        ];
    }
}
