<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('grades', function(Blueprint $table)
		{
			$table->foreign('grading_id', 'f_grade_grading_id')->references('id')->on('gradings')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('student_detail_user_id', 'f_grade_student_detail_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('grades', function(Blueprint $table)
		{
			$table->dropForeign('f_grade_grading_id');
			$table->dropForeign('f_grade_student_detail_user_id');
		});
	}

}
