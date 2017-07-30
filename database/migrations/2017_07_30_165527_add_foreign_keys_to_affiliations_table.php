<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAffiliationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('affiliations', function(Blueprint $table)
		{
			$table->foreign('student_detail_user_id', 'fafflistudentdetailuserid')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('affiliations', function(Blueprint $table)
		{
			$table->dropForeign('fafflistudentdetailuserid');
		});
	}

}
