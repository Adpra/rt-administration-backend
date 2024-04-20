<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\TransactionHistory $transactionHistory */

        $transactionHistory = $this;

        return [
            'type' => $transactionHistory->type,
            'status' => $transactionHistory->status,
            'amount' => $transactionHistory->amount,
            'description' => $transactionHistory->description,
            'house_id' => $transactionHistory->house_id,
            'householder_id' => $transactionHistory->householder_id,
            'billing_id' => $transactionHistory->billing_id,
            'created_at' => $transactionHistory->created_at?->format('d-m-Y H:i:s'),
            'updated_at' => $transactionHistory->updated_at?->format('d-m-Y H:i:s'),
        ];
    }
}
