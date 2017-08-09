<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserSchoolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_school', function(Blueprint $table)
		{
			$table->foreign('school_id', 'f_user_school_school_id')->references('id')->on('schools')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'f_user_school_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_school', function(Blueprint $table)
		{
			$table->dropForeign('f_user_school_school_id');
			$table->dropForeign('f_user_school_user_id');
		});
	}

}
