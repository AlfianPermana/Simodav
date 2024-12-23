<?php

namespace App\Http\Controllers\Admin;

use App\Models\Outlet;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OutletController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		// paginate outlets
		$outlets = Outlet::with('owner')->latest()->paginate(8);

		return view(
			'admins.outlets.index',
			compact('outlets')
		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$users = User::where('role', 'user')->doesntHave('outlet')->get();
		return view('admins.outlets.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreOutletRequest $request): RedirectResponse
	{
		// create outlet
		$outlet = Outlet::create($request->except('image'));

		// check if image uploaded
		if ($request->hasFile('image')) {
			$extension = $request->file('image')->getClientOriginalExtension();
			$name = time() . '.' . $extension;

			$path = $request->file('image')->storeAs(
				'public/outlets',
				$name
			);

			$outlet->update([
				'image' => $path,
			]);
		}

		return redirect()
			->route('admins.outlets.index')
			->with('success', 'Outlet created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Outlet $outlet)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Outlet $outlet): View
	{
		return view('admins.outlets.edit', [
			'outlet' => $outlet->load('owner'),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateOutletRequest $request, Outlet $outlet): RedirectResponse
	{
		// update outlet
		$outlet->update($request->except(['image', 'user_id']));

		// check if image uploaded
		if ($request->hasFile('image')) {
			$extension = $request->file('image')->getClientOriginalExtension();
			$name = time() . '.' . $extension;

			$path = $request->file('image')->storeAs(
				'public/outlets',
				$name
			);

			$outlet->update([
				'image' => $path,
			]);
		}

		return redirect()
			->route('admins.outlets.index')
			->with('success', 'Outlet updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Outlet $outlet): RedirectResponse
	{
		$outlet->delete();

		return redirect()
			->route('admin.outlets.index')
			->with('success', 'Outlet deleted successfully.');
	}
}
