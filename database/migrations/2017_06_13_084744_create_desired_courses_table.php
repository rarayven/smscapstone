<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesiredCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('desired_courses', function(Blueprint $table)
		{
			$table->integer('student_detail_user_id')->unsigned()->index('fdesi_application_user_id_idx');
			$table->integer('course_id')->unsigned()->index('fdesi_course_id_idx');
			$table->integer('school_id')->unsigned()->index('fdesi_school_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('desired_courses');
	}

}
