<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceVariation extends Model
{
	protected $fillable = [
		'service_id',
		'variation_name',
		'price_min',
		'price_max',
		'description',
		'is_price_max_and_up'
	];

	// Relationships
	public function service() {return $this->belongsTo('App\Service');}

	// Custom Functions
	public function getPrice($inPHP=false) {
		$price = '';

		$price_min = number_format($this->price_min, 2);
		if ($this->price_max != null)
			$price_max = number_format($this->price_max, 2);

		if ($inPHP) {
			$price_min = '₱ ' . $price_min;
			if ($this->price_max != null)
				$price_max = '₱ ' . $price_max;
		}

		if ($this->is_price_max_and_up) {
			$price = '₱ ' . $this->price_min . ' and up.';
		}
		else {
			if ($this->price_max == null) {
				$price = $price_min;
			}
			else {
				$price = $price_min . ' - ' . $price_max;
			}
		}

		return $price;
	}
}