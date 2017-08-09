<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_course', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('f_user_course_user_id_idx');
			$table->integer('course_id')->unsigned()->index('f_user_course_course_id_idx');
			$table->unique(['user_id','course_id'], 'user_course');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_course');
	}

}
