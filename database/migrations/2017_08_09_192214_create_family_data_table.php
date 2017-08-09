<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamilyDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('family_data', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('student_detail_user_id', 30)->index('ffamily_data_application_user_id_idx');
			$table->string('first_name', 25);
			$table->string('last_name', 25);
			$table->string('citizenship', 25);
			$table->string('highest_ed', 25);
			$table->string('occupation', 25);
			$table->string('monthly_income', 20);
			$table->boolean('member_type')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('family_data');
	}

}
