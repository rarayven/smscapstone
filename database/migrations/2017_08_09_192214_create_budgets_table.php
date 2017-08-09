<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBudgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budgets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('fallocations_users_id_idx');
			$table->integer('councilor_id')->unsigned()->index('fallocation_councilor_id_idx');
			$table->float('amount', 10, 0)->unsigned();
			$table->float('budget_per_student', 10, 0)->unsigned();
			$table->integer('slot_count')->unsigned();
			$table->dateTime('budget_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('budgets');
	}

}
