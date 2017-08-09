<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouncilorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('councilors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('district_id')->unsigned()->index('fcouncilor_district_id_idx');
			$table->string('first_name', 25);
			$table->string('middle_name', 25)->nullable();
			$table->string('last_name', 25);
			$table->string('cell_no', 15);
			$table->string('email', 30)->unique('email_UNIQUE');
			$table->string('picture', 36)->default('Default.png');
			$table->boolean('is_active')->default(1);
			$table->softDeletes();
			$table->unique(['first_name','middle_name','last_name'], 'counname_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('councilors');
	}

}
