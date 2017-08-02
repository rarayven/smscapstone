<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserRequirementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_requirement', function(Blueprint $table)
		{
			$table->foreign('grade_id', 'fstudent_steps_grade_id')->references('id')->on('grades')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requirement_id', 'fstudent_steps_step_id')->references('id')->on('requirements')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
		Schema::table('user_requirement', function(Blueprint $table)
		{
			$table->dropForeign('fstudent_steps_grade_id');
			$table->dropForeign('fstudent_steps_step_id');
			$table->dropForeign('fstudent_steps_user_id');
		});
	}

}
