<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_event', function(Blueprint $table)
		{
			$table->foreign('event_id', 'fatte_event_id')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fatte_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_event', function(Blueprint $table)
		{
			$table->dropForeign('fatte_event_id');
			$table->dropForeign('fatte_user_id');
		});
	}

}
