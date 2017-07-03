<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicGradingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academic_gradings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('description', 25)->unique('description_UNIQUE');
			$table->string('highest_grade', 4);
			$table->string('lowest_grade', 4);
			$table->string('failing_grade', 4);
			$table->boolean('is_active')->default(1);
			$table->unique(['highest_grade','lowest_grade'], 'idx_gradevalue');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('academic_gradings');
	}

}
