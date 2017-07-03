<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserStepTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_step', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index('fstudent_steps_user_id_idx');
			$table->integer('step_id')->unsigned()->index('fstudent_steps_step_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_step');
	}

}
