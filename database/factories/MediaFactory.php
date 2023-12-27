<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<\App\Models\Media>
 */
final class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'alt_text' => fake()->word,
            'path' => fake()->image(storage_path("app/public/products"), fullPath: false),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
