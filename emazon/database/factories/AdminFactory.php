<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     *
     * @return array<string, mixed>
     */
    protected static ?string $password= "12345678";

    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'gender'    => random_int(1, 2),
            'phone'     => fake()->e164PhoneNumber(),
            'email'     => fake()->unique()->safeEmail(),
            'password'  => static::$password ??= Hash::make('password'),
            'role'      => random_int(0, 1),
        ];
    }


}
