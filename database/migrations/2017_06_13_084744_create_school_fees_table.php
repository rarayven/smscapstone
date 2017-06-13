<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolFeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('school_fees', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index('fschool_fees_user_id_idx');
			$table->integer('allocation_id')->unsigned()->index('fallocation_id_idx');
			$table->integer('allocation_type_id')->unsigned()->index('fallocation_type_id_idx');
			$table->float('fees_amount', 10, 0)->unsigned();
			$table->dateTime('fees_date');
			$table->boolean('is_given_alllowance')->default(0);
			$table->boolean('is_got_stipend')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('school_fees');
	}

}
