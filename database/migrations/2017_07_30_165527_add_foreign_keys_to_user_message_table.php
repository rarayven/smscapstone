<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_message', function(Blueprint $table)
		{
			$table->foreign('message_id', 'frece_message_id')->references('id')->on('messages')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'frece_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_message', function(Blueprint $table)
		{
			$table->dropForeign('frece_message_id');
			$table->dropForeign('frece_user_id');
		});
	}

}
