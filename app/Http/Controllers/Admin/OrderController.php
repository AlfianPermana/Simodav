<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$filter = $request->get('filter', 'all');

		$orders = Order::when($filter == 'today', function ($query) {
			return $query->whereDate('created_at', today());
		})->when($filter == 'week', function ($query) {
			return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
		})->when($filter == 'month', function ($query) {
			return $query->whereMonth('created_at', now()->month);
		})->with('outlet')->withCount('items')->latest()->paginate(8);

		return view(
			'admins.orders.index',
			compact('orders')
		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreOrderRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Order $order)
	{
		return view(
			'admins.orders.show',
			[
				'order' => $order->load('outlet', 'items'),
			]
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Order $order)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateOrderRequest $request, Order $order)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Order $order)
	{
		//
	}
}
