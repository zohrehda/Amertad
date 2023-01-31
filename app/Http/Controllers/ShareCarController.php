<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareCarRequest;
use App\Http\Requests\ShareCarReleaseRequest;
use App\Http\Requests\ShareCarLockRequest;
use App\Models\Car;
use App\Repositories\CarRepository;

class ShareCarController extends Controller
{

    private $repository;

    public function __construct(CarRepository $repository)
    {
        return  $this->repository = $repository;
    }

    public function  isAccessible(Car $car)
    {
        return  $this->success(
            trans('messages.retrieve'),
            [
                'is_accessible' => $this->repository->isAccessible($car)
            ]
        );
    }

    public function share(ShareCarRequest $request, Car $car)
    {
        $this->repository->share($car, $request->input('shares'));

        return  $this->success(
            'car shared successfully'
        );
    }

    public function release(ShareCarReleaseRequest $request, Car $car)
    {
        $this->repository->release($car, $request->input('customer_id'));

        return  $this->success(
            'share released successfully'
        );
    }

    public function lock(ShareCarLockRequest $request, Car $car)
    {
        $this->repository->lock($car, $request->input('customer_id'));

        return  $this->success(
            'share locked successfully'
        );
    }
}
