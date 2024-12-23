<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OutletController as AdminOutletController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InvetarisController as AdminInvetarisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
	Route::get('/', function () {
		if (auth()->user()->role === 'admin')
			return redirect()->route('admins.dashboard.index');
		return redirect()->route('dashboards.index');
	})->name('home');
});

Auth::routes([
	'register' => false,
	'reset' => false,
	'verify' => false,
]);

Route::prefix('admins')->name('admins.')->middleware(['auth', 'role:admin'])->group(function () {
	Route::resource('dashboard', AdminDashboardController::class)->only(['index']);
	Route::resource('invetaris', AdminInvetarisController::class);
	Route::resource('users', AdminUserController::class);
	Route::resource('outlets', AdminOutletController::class);
	Route::resource('products', AdminProductController::class);
	Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
});

Route::middleware(['auth', 'role:user'])->group(function () {
	Route::resource('dashboards', DashboardController::class);
	Route::resource('products', ProductController::class);

	Route::get('orders/current', [OrderController::class, 'current'])->name('orders.current');
	Route::get('orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
	Route::resource('orders', OrderController::class)->only(['index', 'show']);

	Route::post('products/{product}/add', [ProductController::class, 'add'])->name('products.add');
	Route::post('products/{product}/remove', [ProductController::class, 'remove'])->name('products.remove');
});
