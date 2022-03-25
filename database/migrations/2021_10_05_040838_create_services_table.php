<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('service_category_id')->unsigned();
			$table->string('service_name');
			$table->mediumText('description');
			$table->timestamps();

			$table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('services');
	}
}
