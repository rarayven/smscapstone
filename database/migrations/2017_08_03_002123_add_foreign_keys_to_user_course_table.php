<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_course', function(Blueprint $table)
		{
			$table->foreign('course_id', 'f_user_course_course_id')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'f_user_course_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_course', function(Blueprint $table)
		{
			$table->dropForeign('f_user_course_course_id');
			$table->dropForeign('f_user_course_user_id');
		});
	}

}
