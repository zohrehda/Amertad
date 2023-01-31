<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name'
    ];

    public function shares()
    {
        return $this->hasMany(SharedCar::class, 'car_id');
    }
}
