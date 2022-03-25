<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_order_products', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('purchase_order_id')->unsigned();
			$table->string('product_name');
			$table->double('price', 15, 2)->default('0.00');
			$table->integer('quantity')->unsigned();
			$table->mediumText('description')->nullable();
			$table->timestamps();

			$table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('purchase_order_products');
	}
}