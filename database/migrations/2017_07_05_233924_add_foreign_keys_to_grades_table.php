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
			$table->foreign('semester_id', 'fgrade_sem_id')->references('id')->on('semesters')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('student_detail_user_id', 'fgrade_student_detail_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('year_id', 'fgrade_year_id')->references('id')->on('years')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
			$table->dropForeign('fgrade_sem_id');
			$table->dropForeign('fgrade_student_detail_user_id');
			$table->dropForeign('fgrade_year_id');
		});
	}

}
