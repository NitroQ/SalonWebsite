<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales_order_services', function (Blueprint $table) {
			$table->integer('sales_order_id')->unsigned();
			$table->integer('service_variation_id')->unsigned();
			$table->decimal('price')->default(0);
			$table->integer('quantity')->unsigned()->default(0);

			$table->foreign('sales_order_id')->references('id')->on('sales_orders')->onDelete('cascade');
			$table->foreign('service_variation_id')->references('id')->on('service_variations')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sales_order_services');
	}
}