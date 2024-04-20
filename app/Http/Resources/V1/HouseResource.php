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
            'next_billing_date' => $house->next_billing_date,
            'billing_date_expired' => $house->billing_date_expired,
            'house_holders' => $this->when($request->route()->getActionMethod() === 'show', HouseHolderResource::collection($house->houseHolders)),
        ];
    }
}
