<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		// paginate products
		$products = Product::latest()->paginate(10);

		return view(
			'admins.products.index',
			compact('products')
		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('admins.products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreProductRequest $request): RedirectResponse
	{
		// create product
		$product = Product::create($request->except('image'));

		// check if image uploaded
		if ($request->hasFile('image')) {
			$extension = $request->file('image')->getClientOriginalExtension();
			$name = time() . '.' . $extension;

			$path = $request->file('image')->storeAs(
				'public/products',
				$name
			);

			$product->update([
				'image' => $path,
			]);
		}

		return redirect()
			->route('admins.products.index')
			->with('success', 'Produk berhasil ditambahkan');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Product $product)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Product $product): View
	{
		return view('admins.products.edit', compact('product'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProductRequest $request, Product $product): RedirectResponse
	{
		// update product
		$product->update($request->except('image'));

		// check if image uploaded
		if ($request->hasFile('image')) {
			$extension = $request->file('image')->getClientOriginalExtension();
			$name = time() . '.' . $extension;

			$path = $request->file('image')->storeAs(
				'public/products',
				$name
			);

			if ($product->image) Storage::delete($product->image);
			$product->update([
				'image' => $path,
			]);
		}

		return redirect()
			->route('admins.products.index')
			->with('success', 'Produk berhasil diupdate');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Product $product): RedirectResponse
	{
		$product->delete();

		return redirect()
			->route('admins.products.index')
			->with('success', 'Produk berhasil dihapus');
	}
}
