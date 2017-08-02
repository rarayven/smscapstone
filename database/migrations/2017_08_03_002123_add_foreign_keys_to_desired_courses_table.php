<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDesiredCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('desired_courses', function(Blueprint $table)
		{
			$table->foreign('student_detail_user_id', 'fdesi_application_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('course_id', 'fdesi_course_id')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('school_id', 'fdesi_school_id')->references('id')->on('schools')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('desired_courses', function(Blueprint $table)
		{
			$table->dropForeign('fdesi_application_user_id');
			$table->dropForeign('fdesi_course_id');
			$table->dropForeign('fdesi_school_id');
		});
	}

}
