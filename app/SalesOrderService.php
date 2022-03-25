<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrderService extends Model
{
	protected $fillable = [
		'sales_order_id',
		'service_variation_id',
		'price',
		'quantity'
	];

	public $timestamps = false;

	// Relationships
	protected function salesOrder() {return $this->belongsTo('App\SalesOrder');}
	protected function serviceVariation() {return $this->belongsTo('App\ServiceVariation');}
	public function service() {return $this->serviceVariation->service;}
	public function serviceCategory() {return $this->serviceVariation->service->serviceCategory;}

	public function getPrice($inPHP=false) {
		$price = '';

		$price = number_format($this->price, 2);

		if ($inPHP) {
			$price = '₱ ' . $price;
		}

		return $price;
	}
}