<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserCouncilorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_councilor', function(Blueprint $table)
		{
			$table->foreign('councilor_id', 'fconnection_councilor_id')->references('id')->on('councilors')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fconnection_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_councilor', function(Blueprint $table)
		{
			$table->dropForeign('fconnection_councilor_id');
			$table->dropForeign('fconnection_user_id');
		});
	}

}
