<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGradingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('grading_details', function(Blueprint $table)
		{
			$table->foreign('grading_id', 'facademic_grading_detail_id')->references('id')->on('gradings')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('grading_details', function(Blueprint $table)
		{
			$table->dropForeign('facademic_grading_detail_id');
		});
	}

}
