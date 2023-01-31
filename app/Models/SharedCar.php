<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedCar extends Model
{
    use HasFactory;

    protected  $fillable = [
        'customer_id',
        'car_id',
        'percentage',
        'is_released'
    ];

    protected $casts = [
        'is_released' => 'boolean'
    ];
}
