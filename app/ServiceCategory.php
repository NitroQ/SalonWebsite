<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
	protected $fillable = [
		'category_name',
		'description'
	];

	// Relationships
	protected function services() {return $this->hasMany('App\Service');}
	protected function serviceVariations() {return $this->hasManyThrough('App\ServiceVariation', 'App\Service', 'service_category_id', 'service_id', 'id');}
}