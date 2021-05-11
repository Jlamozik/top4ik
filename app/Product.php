<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $timestamps = false;
    use HasFactory;

	protected $fillable = 
	[
		'id',
		'name',
		'count',
		'price',
	];
}
