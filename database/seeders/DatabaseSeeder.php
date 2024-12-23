<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::factory()->create([
			'name' => 'Administrator',
			'email' => 'develop@kebab.com',
			'password' => '21122001ggwp',
			'role' => 'admin',
		]);

	/*	Outlet::factory()->count(30)->create();
		Product::factory()->count(100)->create();

		Order::factory()->count(500)->create()
			->each(function (Order $order) {
				OrderItem::factory()->count(rand(1, 10))->create([
					'order_id' => $order->id,
				]);
			});

		Order::all()->each(function (Order $order) {
			$order->update([
				'total' => $order->items->sum('subtotal'),
			]);
		});*/
	}
}
