<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserAnnouncementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_announcement', function(Blueprint $table)
		{
			$table->foreign('announcement_id', 'fk_announcement_id')->references('id')->on('announcements')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id', 'fk_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_announcement', function(Blueprint $table)
		{
			$table->dropForeign('fk_announcement_id');
			$table->dropForeign('fk_user_id');
		});
	}

}
