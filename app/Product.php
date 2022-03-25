<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'product_name',
		'price',
		'description',
		'in_stock',
		'status'
	];

	// Relationships
	protected function salesOrderProduct() {return $this->hasMany('App\SalesOrderProduct');}
}