<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales_order_products', function(Blueprint $table) {
			$table->integer('sales_order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('quantity')->unsigned()->default(0);

			$table->foreign('sales_order_id')->references('id')->on('sales_orders')->onDelete('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sales_order_products');
	}
}
