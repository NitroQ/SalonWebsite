<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $fillable = [
		'service_category_id',
		'service_name',
		'description'
	];

	// Relationships
	protected function serviceCategory() {return $this->belongsTo('App\ServiceCategory');}
	protected function salesOrderServices() {return $this->hasMany('App\SalesOrderService');}
	protected function serviceVariations() {return $this->hasMany('App\ServiceVariation');}
}