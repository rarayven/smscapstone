<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAffiliationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliations', function(Blueprint $table)
		{
			$table->string('student_detail_user_id', 30)->index('fafflistudentdetailuserid_idx');
			$table->string('organization', 50);
			$table->string('position', 25);
			$table->string('participation_date', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('affiliations');
	}

}
