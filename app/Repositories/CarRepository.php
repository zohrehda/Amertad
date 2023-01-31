<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\SharedCar;

class CarRepository
{
    public function release(Car $car, $customer_id)
    {
        $car->shares()->where('customer_id', $customer_id)
            ->update([
                'is_released' => true
            ]);
    }

    public function lock(Car $car, $customer_id)
    {
        $car->shares()->where('customer_id', $customer_id)
            ->update([
                'is_released' => false
            ]);
    }

    public function share(Car $car, $data)
    {
        SharedCar::where('car_id', $car->id)->delete();

        $data = array_map(function ($array) use ($car) {
            return array_merge($array, ['car_id' => $car->id]);
        }, $data);

        SharedCar::insert($data);
    }

    public function isAccessible(Car $car)
    {
        return   $car->shares->count() ==  $car->shares->where('is_released', 1)->count();
    }
}
