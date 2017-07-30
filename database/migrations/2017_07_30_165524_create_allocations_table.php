<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAllocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('allocations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budget_id')->unsigned()->index('fallocationsbudget_id_idx');
			$table->integer('allocation_type_id')->unsigned()->index('fallocationallocationtype_idx');
			$table->float('amount', 10, 0)->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('allocations');
	}

}
