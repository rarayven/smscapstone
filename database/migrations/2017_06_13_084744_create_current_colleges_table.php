<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrentCollegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_colleges', function(Blueprint $table)
		{
			$table->integer('student_detail_user_id')->unsigned()->index('fcurr_application_user_id_idx');
			$table->integer('school_id')->unsigned()->index('fschool_id_idx');
			$table->integer('course_id')->unsigned()->index('fcourse_id_idx');
			$table->string('gwa', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_colleges');
	}

}
