<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
    ];

    public function houseHolders(){
        return $this->hasMany(HouseHolder::class);
    }

    public function transactions(){
        return $this->hasMany(TransactionHistory::class);
    }

    public function enum(){
        return $this->belongsTo(Enum::class, 'status', 'id')->where('type', 'house_status');
    }

}
