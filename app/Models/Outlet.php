<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outlet extends Model
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
		'address',
		'phone',
		'image',
		'user_id',
	];

	/**
	 * Get the owner that owns the outlet.
	 */
	public function owner(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * Get the orders for the outlet.
	 */
	public function orders(): HasMany
	{
		return $this->hasMany(Order::class);
	}

	/**
	 * Get the image URL for the outlet.
	 *
	 * @return string
	 */
	public function getImageAttribute($value): string
	{
		return $value ? Storage::url($value) : 'https://via.placeholder.com/150';
	}

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
}
