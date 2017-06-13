<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCurrentCollegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('current_colleges', function(Blueprint $table)
		{
			$table->foreign('course_id', 'fcourse_id')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('student_detail_user_id', 'fcurr_application_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
		Schema::table('current_colleges', function(Blueprint $table)
		{
			$table->dropForeign('fcourse_id');
			$table->dropForeign('fcurr_application_user_id');
			$table->dropForeign('fschool_id');
		});
	}

}
