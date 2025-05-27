<?php

namespace Database\Factories;

use App\Models\WeightTarget;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;

    public function definition()
    {
        return [
            'user_id' => null,
            'target_weight' => $this->faker->randomFloat(1, 55, 70),
        ];
    }
}
