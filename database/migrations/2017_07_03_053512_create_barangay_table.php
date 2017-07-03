<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangay', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('district_id')->unsigned()->index('fbarangay_district_id_idx');
			$table->string('description', 25)->unique('description_UNIQUE');
			$table->boolean('is_active')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('barangay');
	}

}
