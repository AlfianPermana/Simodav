<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invetarispenge extends Model
{
    use HasFactory;

    protected $fillable = [
		'penanggungjawab',
		'totalpengeluaran',
		'notaimage',
	];

    public function getImageAttribute($value): string
	{
		return $value ? Storage::url($value) : '';
	}
}
