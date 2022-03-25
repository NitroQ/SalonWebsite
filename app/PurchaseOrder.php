<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
	protected $fillable = [
		'supplier_id',
		'description',
		'status',
		'is_accepted'
	];

	// Relationships
	protected function supplier() {return $this->belongsTo('App\Suppliers');}
	protected function products() {return $this->hasMany('App\PurchaseOrderProducts', 'purchase_order_id', 'id');}

	// Custom Functions
	public function total($inPHP=false) {
		$total = 0;

		foreach ($this->products as $p)
			$total += $p->quantity * $p->price;
		
		if ($inPHP)
			return '₱' . number_format($total, 2);
		return $total;
	}
}