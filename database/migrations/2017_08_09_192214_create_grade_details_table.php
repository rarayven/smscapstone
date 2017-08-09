<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grade_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('grade_id')->unsigned()->index('fgrade_details_grade_id_idx');
			$table->string('description', 45);
			$table->char('units', 1)->default(0);
			$table->string('grade', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grade_details');
	}

}
