<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
	use HasFactory;
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'outlet_id',
		'total',
		'status',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'total' => 'decimal:2',
	];

	/**
	 * Get the outlet that owns the order.
	 */
	public function outlet(): BelongsTo
	{
		return $this->belongsTo(Outlet::class);
	}

	/**
	 * Get the order items for the order.
	 */
	public function items(): HasMany
	{
		return $this->hasMany(OrderItem::class);
	}
}
