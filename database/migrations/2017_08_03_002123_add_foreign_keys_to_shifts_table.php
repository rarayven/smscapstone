<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shifts', function(Blueprint $table)
		{
			$table->foreign('course_id', 'fshift_course_id')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('school_id', 'fshift_school_id')->references('id')->on('schools')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fshift_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shifts', function(Blueprint $table)
		{
			$table->dropForeign('fshift_course_id');
			$table->dropForeign('fshift_school_id');
			$table->dropForeign('fshift_user_id');
		});
	}

}
