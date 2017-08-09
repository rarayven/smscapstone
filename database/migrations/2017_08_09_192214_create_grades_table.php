<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('student_detail_user_id', 30);
			$table->integer('grading_id')->unsigned()->index('f_grade_grading_id_idx');
			$table->char('year', 1)->default(1);
			$table->char('semester', 1)->default(0);
			$table->string('pdf', 50)->unique('pdf_UNIQUE');
			$table->unique(['student_detail_user_id','year','semester'], 'fgrade_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grades');
	}

}
