<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserAllocationTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_allocation_type', function(Blueprint $table)
		{
			$table->foreign('allocation_type_id', 'f_user_allocation_allocation_type_id')->references('id')->on('allocation_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'f_user_allocation_type_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_allocation_type', function(Blueprint $table)
		{
			$table->dropForeign('f_user_allocation_allocation_type_id');
			$table->dropForeign('f_user_allocation_type_user_id');
		});
	}

}
