<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFamilyDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('family_data', function(Blueprint $table)
		{
			$table->foreign('student_detail_user_id', 'ffamily_data_application_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('family_data', function(Blueprint $table)
		{
			$table->dropForeign('ffamily_data_application_user_id');
		});
	}

}
