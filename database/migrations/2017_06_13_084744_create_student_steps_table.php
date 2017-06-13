<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentStepsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_steps', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index('fstudent_steps_user_id_idx');
			$table->integer('step_id')->unsigned()->index('fstudent_steps_step_id_idx');
			$table->dateTime('completion_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_steps');
	}

}
