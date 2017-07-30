<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBudgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('budgets', function(Blueprint $table)
		{
			$table->foreign('councilor_id', 'fallocation_councilor_id')->references('id')->on('councilors')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fallocations_users_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('budgets', function(Blueprint $table)
		{
			$table->dropForeign('fallocation_councilor_id');
			$table->dropForeign('fallocations_users_id');
		});
	}

}
