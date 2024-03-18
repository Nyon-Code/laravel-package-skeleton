<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Vendor\LaravelPackageSkeleton\Models\Skeleton;

class SkeletonFactory extends Factory
{
    protected $model = Skeleton::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
