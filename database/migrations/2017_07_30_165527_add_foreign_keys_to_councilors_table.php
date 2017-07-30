<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCouncilorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('councilors', function(Blueprint $table)
		{
			$table->foreign('district_id', 'fcouncilor_district_id')->references('id')->on('districts')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('councilors', function(Blueprint $table)
		{
			$table->dropForeign('fcouncilor_district_id');
		});
	}

}
