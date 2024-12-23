<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Outlet>
 */
class OutletFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$user = User::factory()->create([
			'role' => 'user',
		]);

		return [
			'user_id' => $user->id,
			'name' => fake()->company(),
			'address' => fake()->address(),
			'phone' => fake()->phoneNumber(),
			'created_at' => now()->subDays(rand(0, 30)),
		];
	}
}
