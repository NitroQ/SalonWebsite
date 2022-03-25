<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderProducts extends Model
{
	protected $fillable = [
        'purchase_order_id',
        'product_name',
        'price',
        'quantity',
        'description'
    ];

    // Relationships
    protected function purchaseOrder() {return $this->belongsTo('App\PurchaseOrder');}
}