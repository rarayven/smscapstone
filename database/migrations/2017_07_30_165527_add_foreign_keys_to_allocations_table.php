<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAllocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('allocations', function(Blueprint $table)
		{
			$table->foreign('allocation_type_id', 'fallocationallocationtype')->references('id')->on('allocation_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('budget_id', 'fallocationsbudget_id')->references('id')->on('budgets')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('allocations', function(Blueprint $table)
		{
			$table->dropForeign('fallocationallocationtype');
			$table->dropForeign('fallocationsbudget_id');
		});
	}

}
