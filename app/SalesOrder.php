<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
	protected $fillable = [
		'customer_name',
		'description'
	];

	// Relationships
	protected function salesOrderService() {return $this->hasMany('App\SalesOrderService');}
	protected function salesOrderProduct() {return $this->hasMany('App\SalesOrderProduct');}

	// Custom Functions
	public function total($inPHP=false) {
		$total = 0;

		foreach ($this->salesOrderService as $sos)
			$total += $sos->quantity * $sos->price;
		
		if ($inPHP)
			return '₱' . number_format($total, 2);
		return $total;
	}
}