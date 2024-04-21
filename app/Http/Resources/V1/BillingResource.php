<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Billing $billing */

        $billing = $this;

        return [
            'id' => $billing->id,
            'type' => $billing->type,
            'amount' => $billing->amount,
            'description' => $billing->description,
            'status_name' => $billing->enum->name,
            'status' => $billing->status,
            'created_at' => $billing->created_at?->format('d-m-Y H:i:s'),
            'updated_at' => $billing->updated_at?->format('d-m-Y H:i:s'),
        ];
    }
}
