<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invetarispenge;
use App\Http\Requests\StoreInvetarisRequest;
use App\Http\Requests\UpdateInvetarisRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvetarisController extends Controller
{
    /**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		// paginate products
		$inve = Invetarispenge::latest()->paginate(10);

		return view(
			'admins.invetaris.index',
			compact('inve')
		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('admins.invetaris.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreInvetarisRequest $request): RedirectResponse
	{
		// create product
		$inve = Invetarispenge::create($request->except('notaimage'));

		// check if image uploaded
		if ($request->hasFile('notaimage')) {
			$extension = $request->file('notaimage')->getClientOriginalExtension();
			$name = time() . '.' . $extension;

			$path = $request->file('notaimage')->storeAs(
				'public/nota',
				$name
			);

			$product->update([
				'notaimage' => $path,
			]);
		}

		return redirect()
			->route('admins.invetaris.index')
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
		return view('admins.invetaris.edit', compact('inve'));
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
	public function destroy(Invetarispenge $product): RedirectResponse
	{
		$inve->delete();

		return redirect()
			->route('admins.invetaris.index')
			->with('success', 'Produk berhasil dihapus');
	}
}
