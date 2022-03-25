<?php

use Illuminate\Database\Seeder;

use App\Service;
use App\ServiceCategory;
use App\ServiceVariation;

class ServicesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Service Categories
		$regulars = ServiceCategory::create([
			'category_name' => 'Regulars',
			'description' => 'Regulars'
		]);

		$treatments = ServiceCategory::create([
			'category_name' => 'Treatments',
			'description' => 'Treatments'
		]);

		$technical = ServiceCategory::create([
			'category_name' => 'Technical',
			'description' => 'Technical'
		]);

		$color = ServiceCategory::create([
			'category_name' => 'Coloring',
			'description' => 'Coloring'
		]);

		// Services
		#Regulars
		{
			#Haircut with Blowdry
			$hwb = Service::create([
				'service_category_id' => $regulars->id,
				'service_name' => 'Haircut with Blowdry',
				'description' => 'Haircut with Blowdry'
			]);

			ServiceVariation::create([
				'service_id' => $hwb->id,
				'variation_name' => null,
				'price_min' => 70,
				'price_max' => null,
				'description' => $hwb->description,
				'is_price_max_and_up' => 0
			]);

			#Haircut with Blowdry and Shampoo
			$hwbs = Service::create([
				'service_category_id' => $regulars->id,
				'service_name' => 'Haircut with Blowdry and Shampoo',
				'description' => 'Haircut with Blowdry and Shampoo'
			]);

			ServiceVariation::create([
				'service_id' => $hwbs->id,
				'variation_name' => null,
				'price_min' => 100,
				'price_max' => 150,
				'description' => $hwbs->description,
				'is_price_max_and_up' => 0
			]);

			#Shampoo and Blowdry
			$sb = Service::create([
				'service_category_id' => $regulars->id,
				'service_name' => 'Shampoo and Blowdry',
				'description' => 'Shampoo and Blowdry'
			]);

			ServiceVariation::create([
				'service_id' => $sb->id,
				'variation_name' => null,
				'price_min' => 80,
				'price_max' => null,
				'description' => $sb->description,
				'is_price_max_and_up' => 1
			]);

			#Shampoo, Blowdry and Iron
			$sbi = Service::create([
				'service_category_id' => $regulars->id,
				'service_name' => 'Shampoo with Blowdry and Iron',
				'description' => 'Shampoo with Blowdry and Iron'
			]);

			ServiceVariation::create([
				'service_id' => $sbi->id,
				'variation_name' => null,
				'price_min' => 100,
				'price_max' => null,
				'description' => $sbi->description,
				'is_price_max_and_up' => 1
			]);

			#Eyebrow Shaving
			$es = Service::create([
				'service_category_id' => $regulars->id,
				'service_name' => 'Eyebrow Shaving',
				'description' => 'Eyebrow Shaving'
			]);

			ServiceVariation::create([
				'service_id' => $es->id,
				'variation_name' => null,
				'price_min' => 30,
				'price_max' => null,
				'description' => $es->description,
				'is_price_max_and_up' => 0
			]);

			#Eyebrow Shaving
			$et = Service::create([
				'service_category_id' => $regulars->id,
				'service_name' => 'Eyebrow Threading',
				'description' => 'Eyebrow Threading'
			]);

			ServiceVariation::create([
				'service_id' => $et->id,
				'variation_name' => null,
				'price_min' => 100,
				'price_max' => null,
				'description' => $et->description,
				'is_price_max_and_up' => 0
			]);
		}

		#Treatments
		{
			#Collagen Treatment
			$ct = Service::create([
				'service_category_id' => $treatments->id,
				'service_name' => 'Collagen Treatment',
				'description' => 'Collagen Treatment'
			]);

			ServiceVariation::create([
				'service_id' => $ct->id,
				'variation_name' => 'Short',
				'price_min' => 550,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $ct->id,
				'variation_name' => 'Med',
				'price_min' => 700,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $ct->id,
				'variation_name' => 'Long',
				'price_min' => 900,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Mask Treatment
			$mt = Service::create([
				'service_category_id' => $treatments->id,
				'service_name' => 'Mask Treatment',
				'description' => 'Mask Treatment'
			]);

			ServiceVariation::create([
				'service_id' => $mt->id,
				'variation_name' => 'Short',
				'price_min' => 350,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $mt->id,
				'variation_name' => 'Med',
				'price_min' => 450,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $mt->id,
				'variation_name' => 'Long',
				'price_min' => 350,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Deep Scalp Cleansing
			$dsc = Service::create([
				'service_category_id' => $treatments->id,
				'service_name' => 'Deep Scalp Cleansing',
				'description' => 'Deep Scalp Cleansing'
			]);

			ServiceVariation::create([
				'service_id' => $dsc->id,
				'variation_name' => 'Short',
				'price_min' => 350,
				'price_max' => 500,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
		}

		#Technical
		{
			#Brazilian Blowout
			$bb = Service::create([
				'service_category_id' => $technical->id,
				'service_name' => 'Brazilian Blowout',
				'description' => 'Brazilian Blowout'
			]);

			ServiceVariation::create([
				'service_id' => $bb->id,
				'variation_name' => 'Short',
				'price_min' => 1000,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $bb->id,
				'variation_name' => 'Med',
				'price_min' => 1500,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $bb->id,
				'variation_name' => 'Long',
				'price_min' => 2000,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Rebonding
			$r = Service::create([
				'service_category_id' => $technical->id,
				'service_name' => 'Rebonding',
				'description' => 'Rebonding'
			]);

			ServiceVariation::create([
				'service_id' => $r->id,
				'variation_name' => 'Short',
				'price_min' => 1500,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $r->id,
				'variation_name' => 'Med',
				'price_min' => 2000,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $r->id,
				'variation_name' => 'Long',
				'price_min' => 2500,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Perming
			$p = Service::create([
				'service_category_id' => $technical->id,
				'service_name' => 'Perming',
				'description' => 'Perming'
			]);

			ServiceVariation::create([
				'service_id' => $p->id,
				'variation_name' => 'Short',
				'price_min' => 500,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $p->id,
				'variation_name' => 'Med',
				'price_min' => 700,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $p->id,
				'variation_name' => 'Long',
				'price_min' => 2000,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);
		}

		#Coloring
		{
			#Color
			$c = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Color',
				'description' => 'Color'
			]);

			ServiceVariation::create([
				'service_id' => $c->id,
				'variation_name' => 'Men',
				'price_min' => 350,
				'price_max' => null,
				'description' => 'Men',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $c->id,
				'variation_name' => 'Short',
				'price_min' => 550,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $c->id,
				'variation_name' => 'Med',
				'price_min' => 750,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $c->id,
				'variation_name' => 'Long',
				'price_min' => 950,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Gloss Treatment/Cellophane
			$gt = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Gloss Treatment/Cellophane',
				'description' => 'Gloss Treatment/Cellophane'
			]);

			ServiceVariation::create([
				'service_id' => $gt->id,
				'variation_name' => 'Short',
				'price_min' => 600,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $gt->id,
				'variation_name' => 'Med',
				'price_min' => 750,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $gt->id,
				'variation_name' => 'Long',
				'price_min' => 850,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Gloss Treatment
			$gt = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Gloss Treatment',
				'description' => 'Gloss Treatment'
			]);

			ServiceVariation::create([
				'service_id' => $gt->id,
				'variation_name' => 'Short',
				'price_min' => 600,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $gt->id,
				'variation_name' => 'Med',
				'price_min' => 750,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $gt->id,
				'variation_name' => 'Long',
				'price_min' => 850,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Highlights (traditional)
			$ht = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Highlights (traditional)',
				'description' => 'Highlights (traditional)'
			]);

			ServiceVariation::create([
				'service_id' => $ht->id,
				'variation_name' => 'Short',
				'price_min' => 550,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $ht->id,
				'variation_name' => 'Med',
				'price_min' => 800,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);

			#Highlights (foil)
			$hf = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Highlights (foil)',
				'description' => 'Highlights (foil)'
			]);

			ServiceVariation::create([
				'service_id' => $hf->id,
				'variation_name' => 'Short',
				'price_min' => 50,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $hf->id,
				'variation_name' => 'Med',
				'price_min' => 70,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $hf->id,
				'variation_name' => 'Long',
				'price_min' => 90,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Balayage/Ombre
			$bo = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Balayage/Ombre',
				'description' => 'Balayage/Ombre'
			]);

			ServiceVariation::create([
				'service_id' => $bo->id,
				'variation_name' => 'Short',
				'price_min' => 900,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $bo->id,
				'variation_name' => 'Med',
				'price_min' => 1500,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $bo->id,
				'variation_name' => 'Long',
				'price_min' => 2000,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);

			#Bleaching with iplex
			$bwi = Service::create([
				'service_category_id' => $color->id,
				'service_name' => 'Bleaching with iplex',
				'description' => 'Bleaching with iplex'
			]);

			ServiceVariation::create([
				'service_id' => $bwi->id,
				'variation_name' => 'Short',
				'price_min' => 650,
				'price_max' => null,
				'description' => 'Short',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $bwi->id,
				'variation_name' => 'Med',
				'price_min' => 850,
				'price_max' => null,
				'description' => 'Medium',
				'is_price_max_and_up' => 0
			]);
			ServiceVariation::create([
				'service_id' => $bwi->id,
				'variation_name' => 'Long',
				'price_min' => 1050,
				'price_max' => null,
				'description' => 'Long',
				'is_price_max_and_up' => 0
			]);
		}
	}
}