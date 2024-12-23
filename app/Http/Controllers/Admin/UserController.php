<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		// paginate users
		$users = User::latest()->paginate(10);

		// user count
		$total = User::count();
		$week = User::where('created_at', '>=', now()->subWeek())->count();
		$month = User::where('created_at', '>=', now()->subMonth())->count();
		$archived = User::onlyTrashed()->count();

		return view(
			'admins.users.index',
			compact(
				'users',
				'total',
				'week',
				'month',
				'archived'
			)
		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('admins.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreUserRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());
		return redirect()
			->route('admins.users.index')
			->with('success', 'User berhasil ditambahkan');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(User $user)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user): View
	{
		return view('admins.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUserRequest $request, User $user): RedirectResponse
	{
		// remove password if empty
		$data = $request->validated();
		if (empty($data['password'])) {
			unset($data['password']);
		}

		// update user
		$user->update($data);
		return redirect()
			->route('admins.users.index')
			->with('success', 'User berhasil diupdate');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user): RedirectResponse
	{
		// if current user, logout and delete
		if ($user->id === auth()->id()) {
			auth()->logout();
			$user->delete();
			return redirect()->route('login');
		}

		if ($user->role === 'admin') {
			return redirect()
				->route('admins.users.index')
				->with('error', 'User admin tidak dapat dihapus user lain');
		}

		$user->delete();
		return redirect()
			->route('admins.users.index')
			->with('success', 'User berhasil dihapus');
	}
}
