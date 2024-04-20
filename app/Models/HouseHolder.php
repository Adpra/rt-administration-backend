<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseHolder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'photo_ktp',
        'status',
        'marital_status',
        'phone',
        'house_id',
    ];

    public function house(){
        return $this->belongsTo(House::class, 'house_id', 'id');
    }
}
