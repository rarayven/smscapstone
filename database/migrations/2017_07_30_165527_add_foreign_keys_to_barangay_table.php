<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBarangayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('barangay', function(Blueprint $table)
		{
			$table->foreign('district_id', 'fbarangay_district_id')->references('id')->on('districts')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('barangay', function(Blueprint $table)
		{
			$table->dropForeign('fbarangay_district_id');
		});
	}

}
