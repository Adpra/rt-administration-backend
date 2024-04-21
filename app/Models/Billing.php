<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'amount',
        'description',
        'status'
    ];

    public function transactions(){
        return $this->hasMany(TransactionHistory::class);
    }

    public function enum(){
        return $this->belongsTo(Enum::class, 'status', 'id')->where('type', 'billing_status');
    }

}
