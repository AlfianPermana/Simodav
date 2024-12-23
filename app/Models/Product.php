<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory;
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'name',
		'description',
		'price',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'price' => 'decimal:2',
	];


	/**
	 * Get product name initial.
	 *
	 * @return string
	 */
	public function getInitialAttribute(): string
	{
		$words = explode(' ', $this->name);
		$initial = '';
		foreach ($words as $word)
			$initial .= $word[0];
		return strtoupper(substr($initial, 0, 2));
	}

	/**
	 * Get the orders for the product.
	 */
	public function items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
