<?php

namespace App\Http\Resources\v1;

use App\Enums\TransactionStatusEnum;
use App\Enums\TransactionTypeEnum;
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
            'status_name' => $transactionHistory->enum->name,
            'amount' => $transactionHistory->amount,
            'description' => $transactionHistory->description,
            'payment_return_date' => $this->when($transactionHistory->type === TransactionTypeEnum::TAHUNAN && $transactionHistory->status === TransactionStatusEnum::PAID, $this->created_at->addYear()->format('Y-m-d H:i:s')),
            'created_at' => $transactionHistory->created_at?->format('d-m-Y H:i:s'),
            'updated_at' => $transactionHistory->updated_at?->format('d-m-Y H:i:s'),
        ];
    }
}
