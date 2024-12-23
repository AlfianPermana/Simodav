<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'product_id',
		'order_id',
		'quantity',
		'subtotal',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'subtotal' => 'decimal:2',
	];

	/**
	 * Get the product that owns the order item.
	 */
	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class);
	}

	/**
	 * Get the order that owns the order item.
	 */
	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class);
	}
}
