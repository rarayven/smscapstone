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
			$table->integer('student_detail_user_id')->unsigned()->index('fgrade_student_detail_user_id_idx');
			$table->integer('year_id')->unsigned()->index('fgrade_years_id_idx');
			$table->integer('semester_id')->unsigned()->index('fgrade_sem_id_idx');
			$table->string('pdf', 50)->unique('pdf_UNIQUE');
			$table->unique(['student_detail_user_id','year_id','semester_id'], 'fgrade_unique');
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
