<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grading_details', function(Blueprint $table)
		{
			$table->integer('grading_id')->unsigned()->index('facademic_grading_detail_id_idx');
			$table->string('grade', 4);
			$table->boolean('is_passed')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grading_details');
	}

}
