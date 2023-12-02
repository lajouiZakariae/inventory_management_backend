<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\History;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\History>
 */
final class HistoryFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = History::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'operation' => fake()->randomElement(['damage', 'order', 'sale']),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
