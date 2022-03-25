<?php

use Illuminate\Database\Seeder;

use App\SalesOrder;
use App\Product;
use App\SalesOrderProduct;
use App\SalesOrderService;
use App\User;
use App\Suppliers;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		/////////////
		// SEEDERS //
		/////////////
		/* Services Seeder */
		$this->call(ServicesTableSeeder::class);
		
		//////////
		// USER //
		//////////
        User::create([
            'username' => 'Admin102',
            'first_name' => 'Larissa',
            'last_name'=> 'Moana', 
            'type' => 'admin',
            'email'=> 'admin@admin.com' ,
            'password' => Hash::make('admin')
        ]);

        //////////////
        // PRODUCT5 //
        //////////////
		Product::create([
			'product_name' => 'Shampoo',
			'price' => '75.00',
			'description' => 'Shampoo.',
			'in_stock' => 1000,
			'status' => 1
		]);

		Product::create([
			'product_name' => 'Conditioner',
			'price' => '100.00',
			'description' => 'Conditioner.',
			'in_stock' => 1000,
			'status' => 1
		]);

		Product::create([
			'product_name' => 'Collagen',
			'price' => '150.00',
			'description' => 'Collagen.',
			'in_stock' => 1000,
			'status' => 1
		]);

		Product::create([
			'product_name' => 'Mask',
			'price' => '125.00',
			'description' => 'Mask.',
			'in_stock' => 1000,
			'status' => 1
		]);

		/////////////////
		// SALES ORDER //
		/////////////////
		SalesOrder::create([
			'customer_name' => 'Sample Customer',
			'description' => 'Sample description for testing purposes.'
		]);

		SalesOrderService::insert([
			'sales_order_id' => 1,
			'service_variation_id' => 1,
			'price' => 70,
			'quantity' => 1
		]);

		SalesOrderProduct::insert([
			'sales_order_id' => 1,
			'product_id' => 1,
			'quantity' => 2
		]);

		SalesOrderProduct::insert([
			'sales_order_id' => 1,
			'product_id' => 2,
			'quantity' => 3
		]);

		///////////////
		// SUPPLIERS //
		///////////////
		Suppliers::insert([
			'business_name'=> 'EG Salon Materials',
			'contact_number' => "+639461233454",
			'address'=> '#86 Ermita, Manila',
			'description' => 'Coloring and Bleach'
		]);
	}
}