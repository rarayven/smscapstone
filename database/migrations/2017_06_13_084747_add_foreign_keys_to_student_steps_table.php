<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudentStepsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_steps', function(Blueprint $table)
		{
			$table->foreign('step_id', 'fstudent_steps_step_id')->references('id')->on('steps')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fstudent_steps_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_steps', function(Blueprint $table)
		{
			$table->dropForeign('fstudent_steps_step_id');
			$table->dropForeign('fstudent_steps_user_id');
		});
	}

}
