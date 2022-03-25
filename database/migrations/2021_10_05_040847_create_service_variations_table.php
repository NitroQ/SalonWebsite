<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceVariationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_variations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('service_id')->unsigned();
			$table->string('variation_name')->nullable();
			$table->double('price_min', 15, 2);
			$table->double('price_max', 15, 2)->nullable();
			$table->mediumText('description');
			$table->tinyInteger('is_price_max_and_up')->unsigned()->default(0);
			$table->timestamps();

			$table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_variations');
	}
}
