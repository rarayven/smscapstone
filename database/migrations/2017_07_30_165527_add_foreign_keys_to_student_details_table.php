<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_details', function(Blueprint $table)
		{
			$table->foreign('barangay_id', 'fapplication_barangay_id')->references('id')->on('barangay')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('batch_id', 'fapplication_batch_id')->references('id')->on('batches')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('district_id', 'fapplication_district_id')->references('id')->on('districts')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fapplication_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('course_id', 'fcourse_id')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('school_id', 'fschool_id')->references('id')->on('schools')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_details', function(Blueprint $table)
		{
			$table->dropForeign('fapplication_barangay_id');
			$table->dropForeign('fapplication_batch_id');
			$table->dropForeign('fapplication_district_id');
			$table->dropForeign('fapplication_user_id');
			$table->dropForeign('fcourse_id');
			$table->dropForeign('fschool_id');
		});
	}

}
