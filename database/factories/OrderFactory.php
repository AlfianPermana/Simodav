<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$outlet = Outlet::inRandomOrder()->first();

		return [
			'outlet_id' => $outlet->id,
			'status' => 'pending',
			'total' => 0,
			'created_at' => now()->subDays(rand(0, 30)),
		];
	}
}
