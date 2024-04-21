<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\House $house */

        $house = $this;

        return [
            'id' => $house->id,
            'no' => $house->no,
            'description' => $house->description,
            'status' => $house->status,
            'user_id' => $house->user_id,
            'status_name' => $house->enum->name,
            'house_holders' => $this->when($request->route()->getActionMethod() === 'show', HouseHolderResource::collection($house->houseHolders)),
        ];
    }
}
