<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$filter = $request->get('filter', 'all');

		$orders = Order::where('outlet_id', auth()->user()->outlet->id)
			->when($filter == 'today', function ($query) {
				return $query->whereDate('created_at', today());
			})->when($filter == 'week', function ($query) {
				return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
			})->when($filter == 'month', function ($query) {
				return $query->whereMonth('created_at', now()->month);
			})->latest()->paginate(10);

		return view('outlets.orders.index', compact('orders'));
	}

	/**
	 * Display current order.
	 */
	public function current()
	{
		$products = Product::whereIn(
			'id',
			array_keys(
				session()->get(
					'order',
					[]
				)
			)
		)->get();

		return view('outlets.orders.current', compact('products'));
	}

	/**
	 * Checkout all items in the cart.
	 */
	public function checkout(Request $request)
	{
		// if session order is empty
		if (empty(session()->get('order', []))) {
			return redirect()->back()->with('error', 'Please add some products to cart first!');
		}

		$order = Order::create([
			'outlet_id' => auth()->user()->outlet->id,
			'status' => 'completed',
			'total' => 0
		]);

		$total = 0;
		foreach (session()->get('order', []) as $productId => $quantity) {
			$product = Product::find($productId);
			$total += $product->price * $quantity;

			OrderItem::create([
				'order_id' => $order->id,
				'product_id' => $productId,
				'quantity' => $quantity,
				'subtotal' => $product->price * $quantity,
			]);
		}

		$order->update([
			'total' => $total
		]);

		session()->forget('order');
		return redirect()->route('products.index')->with('success', 'Checkout successfully!');
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
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Order $order)
	{
		return view('outlets.orders.show', compact('order'));
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
	public function update(Request $request, Order $order)
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
