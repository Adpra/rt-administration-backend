<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'status',
        'amount',
        'description',
        'house_id',
        'householder_id',
        'billing_id',
        'next_billing_date',
    ];

    public function billing(){
        return $this->belongsTo(Billing::class);
    }

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function enum(){
        return $this->belongsTo(Enum::class, 'status', 'id')->where('type', 'transaction_status');
    }

    public function typeStatus(){
        return $this->belongsTo(Enum::class, 'type', 'id')->where('type', 'type_transaction');
    }

    public function householder(){
        return $this->belongsTo(Householder::class);
    }

}
