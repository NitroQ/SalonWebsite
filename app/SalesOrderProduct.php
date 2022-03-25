<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrderProduct extends Model
{
	protected $fillable = [
		'sales_order_id',
		'product_id',
		'quantity'
	];

	public $timestamps = false;

	// Relationships
	protected function salesOrder() {return $this->belongsTo('App\SalesOrder');}
	protected function product() {return $this->belongsTo('App\Product');}
}