<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'role_id' => fake()->randomNumber(),
            'email' => fake()->safeEmail,
            'email_verified_at' => fake()->optional()->dateTime(),
            'password' => bcrypt(fake()->password),
            'remember_token' => Str::random(10),
        ];
    }
}
