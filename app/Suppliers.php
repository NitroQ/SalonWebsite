<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $fillable = [
        'business_name',
        'contact_number',
        'address',
        'description'
	];

	// Relationship
    protected function purchaseOrder() {return $this->hasMany('App\PurchaseOrder');}
    protected function products() {return $this->hasManyThrough('App\PurchaseOrderProducts', 'App\PurchaseOrder', 'supplier_id', 'purchase_order_id', 'id');}
}
