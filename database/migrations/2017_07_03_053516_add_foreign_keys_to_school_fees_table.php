<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSchoolFeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('school_fees', function(Blueprint $table)
		{
			$table->foreign('allocation_id', 'fallocation_id')->references('id')->on('allocations')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('allocation_type_id', 'fallocation_type_id')->references('id')->on('allocation_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fschool_fees_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('school_fees', function(Blueprint $table)
		{
			$table->dropForeign('fallocation_id');
			$table->dropForeign('fallocation_type_id');
			$table->dropForeign('fschool_fees_user_id');
		});
	}

}
