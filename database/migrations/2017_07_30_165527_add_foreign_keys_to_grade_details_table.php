<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGradeDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('grade_details', function(Blueprint $table)
		{
			$table->foreign('grade_id', 'fgrade_details_grade_id')->references('id')->on('grades')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('grade_details', function(Blueprint $table)
		{
			$table->dropForeign('fgrade_details_grade_id');
		});
	}

}
